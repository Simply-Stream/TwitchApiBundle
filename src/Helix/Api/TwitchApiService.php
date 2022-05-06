<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use GuzzleHttp\Psr7\Uri;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\TokenStorageInterface;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidAccessTokenException;

/**
 * @TODO    : Add parent class or add another service to replace duplicate code
 *
 * @package SimplyStream\TwitchApiBundle\Helix\Api
 */
class TwitchApiService
{
    public const BASE_API_URL = 'https://api.twitch.tv/helix/';

    /** @var ClientInterface */
    protected $client;

    /** @var RequestFactoryInterface */
    protected $requestFactory;

    /** @var TwitchProvider */
    protected $twitch;

    /** @var array */
    protected $options;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        TwitchProvider $twitch,
        array $options
    ) {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
        $this->twitch = $twitch;
        $this->options = $options;
    }

    /**
     * This function will build the query string the way twitch requires it
     *
     * @param array $query
     *
     * @return array|string|string[]|null
     */
    public static function buildQueryString(array $query)
    {
        // Remove empty values and put everything together
        $queryString = http_build_query(array_filter($query), null);

        return preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '=', $queryString);
    }

    /**
     * @param array                     $id
     * @param array                     $game
     * @param AccessTokenInterface|null $accessToken
     *
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function getGames(array $id = [], array $game = [], AccessTokenInterface $accessToken = null): ResponseInterface
    {
        if ($id && $game) {
            throw new \RuntimeException('You can only request by game or id, not both');
        }

        if ((count($id) > 100) || (count($game) > 100)) {
            throw new \RuntimeException('You cannot search for more than 100 ids or games');
        }

        $uri = new Uri(self::BASE_API_URL . 'games');
        $query = self::buildQueryString(['id' => $id, 'game' => $game]);

        return $this->sendRequest($uri->withQuery($query));
    }

    protected function sendRequest(UriInterface $uri, AccessTokenInterface $accessToken = null, string $method = 'GET'): ResponseInterface
    {
        if (! $accessToken) {
            $accessToken = $this->getAccessToken('client_credentials');
        }

        $request = $this->requestFactory->createRequest($method, $uri);
        $request = $request
            ->withHeader('Authorization', ucfirst($accessToken->getValues()['token_type']) . ' ' . $accessToken->getToken())
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Client-ID', $this->options['clientId']);

        return $this->client->sendRequest($request);
    }

    /**
     * @param TokenStorageInterface $tokenStorage
     *
     * @return TwitchApiService
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage): TwitchApiService
    {
        $this->tokenStorage = $tokenStorage;

        return $this;
    }

    /**
     * @param string $grant
     *
     * @return AccessTokenInterface
     */
    protected function getAccessToken(string $grant): AccessTokenInterface
    {
        if ($this->tokenStorage && $this->tokenStorage->has($grant)) {
            return $this->tokenStorage->get($grant);
        }

        $accessToken = null;

        try {
            $accessToken = $this->twitch->getAccessToken($grant);
        } catch (IdentityProviderException $e) {
            throw new InvalidAccessTokenException($accessToken, $e->getMessage());
        }

        return $accessToken;
    }
}
