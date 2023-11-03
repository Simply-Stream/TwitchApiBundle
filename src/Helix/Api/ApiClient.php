<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use CuyZ\Valinor\Mapper\Source\JsonSource;
use CuyZ\Valinor\Mapper\TreeMapper;
use InvalidArgumentException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerTrait;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\InMemoryStorage;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\TokenStorageInterface;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidAccessTokenException;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use function json_decode;

class ApiClient implements ApiClientInterface
{
    use LoggerTrait, LoggerAwareTrait;

    public function __construct(
        protected HttpClientInterface $client,
        protected TwitchProvider $twitch,
        protected TreeMapper $mapper,
        protected array $options = [],
        protected TokenStorageInterface $tokenStorage = new InMemoryStorage()
    ) {
        if (! empty($this->options['token'])) {
            foreach ($this->options['token'] as $grant => $token) {
                $this->tokenStorage->save($grant, new AccessToken([
                    'access_token' => $token['token'],
                    'expires_in' => $token['expires_in'],
                    'token_type' => $token['token_type'],
                ]));
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function sendRequest(
        UriInterface $uri,
        string $type = null,
        string $method = 'GET',
        array $body = null,
        AccessTokenInterface $accessToken = null,
        array $headers = []
    ): ?TwitchResponseInterface {
        if (! $accessToken) {
            $accessToken = $this->getAccessToken('client_credentials');
        }

        $response = $this->client->request($method, $uri, [
            'json' => $body,
            'headers' => array_merge($headers, [
                'Authorization' => ucfirst($accessToken->getValues()['token_type']) . ' ' . $accessToken->getToken(),
                'Content-Type' => 'application/json',
                'Client-ID' => $this->options['clientId'],
            ]),
        ]);

        // @TODO: Make errors more verbose.
        if ($response->getStatusCode() >= 400) {
            $error = json_decode($response->getContent(false), false, 512, JSON_THROW_ON_ERROR);
            $this->error($error->message, ['response' => $response->getContent(false)]);
            throw new InvalidArgumentException(sprintf('Error from API: "(%s): %s"', $error->error, $error->message));
        }

        if ($response->getStatusCode() === 204) {
            return null;
        }

        return $this->mapper->map($type, new JsonSource($response->getContent(false))
        );
    }

    /**
     * @param string $grant
     *
     * @return AccessTokenInterface
     */
    protected function getAccessToken(string $grant): AccessTokenInterface {
        if ($this->tokenStorage->has($grant)) {
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

    /**
     * @param TokenStorageInterface $tokenStorage
     *
     * @return $this
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage): self {
        $this->tokenStorage = $tokenStorage;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function log($level, \Stringable|string $message, array $context = []): void {
        $this->logger?->log($level, $message, $context);
    }
}
