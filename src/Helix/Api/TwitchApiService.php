<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use DateTimeImmutable;
use DateTimeInterface;
use Exception;
use GuzzleHttp\Psr7\Uri;
use InvalidArgumentException;
use JMS\Serializer\SerializerInterface;
use JsonException;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriInterface;
use RuntimeException;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\InMemoryStorage;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\TokenStorageInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\ChannelInformation;
use SimplyStream\TwitchApiBundle\Helix\Dto\Clip;
use SimplyStream\TwitchApiBundle\Helix\Dto\Follows;
use SimplyStream\TwitchApiBundle\Helix\Dto\Game;
use SimplyStream\TwitchApiBundle\Helix\Dto\StreamSchedule;
use SimplyStream\TwitchApiBundle\Helix\Dto\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponse;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchUser;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidAccessTokenException;
use Symfony\Component\HttpFoundation\Request;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\Api
 */
class TwitchApiService
{
    public const BASE_API_URL = 'https://api.twitch.tv/helix/';

    /**
     * @var ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @var RequestFactoryInterface
     */
    protected RequestFactoryInterface $requestFactory;

    /**
     * @var TwitchProvider
     */
    protected TwitchProvider $twitch;

    /**
     * @var array
     */
    protected array $options;

    /**
     * @var TokenStorageInterface|InMemoryStorage
     */
    protected TokenStorageInterface $tokenStorage;

    /**
     * @var SerializerInterface
     */
    protected SerializerInterface $serializer;

    /**
     * @var StreamFactoryInterface
     */
    protected StreamFactoryInterface $streamFactory;

    /**
     * @param ClientInterface         $client
     * @param RequestFactoryInterface $requestFactory
     * @param TwitchProvider          $twitch
     * @param SerializerInterface     $serializer
     * @param StreamFactoryInterface  $streamFactory
     * @param array                   $options
     */
    public function __construct(
        ClientInterface $client,
        RequestFactoryInterface $requestFactory,
        TwitchProvider $twitch,
        SerializerInterface $serializer,
        StreamFactoryInterface $streamFactory,
        array $options = []
    ) {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
        $this->twitch = $twitch;
        $this->serializer = $serializer;
        $this->streamFactory = $streamFactory;
        $this->options = $options;

        // Set an InMemoryStorage initially. Can be overridden by self::setTokenStorage($tokenStorage)
        $this->tokenStorage = new InMemoryStorage();
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
    public function getGames(array $id = [], array $game = [], AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        if ($id && $game) {
            throw new RuntimeException('You can only request by game or id, not both');
        }

        if ((count($id) > 100) || (count($game) > 100)) {
            throw new RuntimeException('You cannot search for more than 100 ids or games');
        }

        if (empty($id) && empty($game)) {
            throw new RuntimeException('You need at least one id or game to request');
        }

        $uri = new Uri(self::BASE_API_URL . 'games');
        $query = self::buildQueryString(['id' => $id, 'name' => $game]);

        return $this->sendRequest($uri->withQuery($query), Game::class, $accessToken);
    }

    /**
     * @param string|null               $after
     * @param string|null               $before
     * @param int                       $first
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponse
     * @throws ClientExceptionInterface
     */
    public function getTopGames(
        string $after = null,
        string $before = null,
        int $first = 20,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        $uri = new Uri(self::BASE_API_URL . 'games/top');
        $query = self::buildQueryString(['after' => $after, 'before' => $before, 'first' => $first]);

        return $this->sendRequest($uri->withQuery($query), Game::class, $accessToken);
    }

    /**
     * @param string                    $id
     * @param string                    $idType - Allowed values: id|game_id|broadcaster_id
     * @param array                     $dateRange
     * @param array                     $cursor
     * @param int                       $first
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponse
     * @throws ClientExceptionInterface
     */
    public function getClips(
        string $id,
        string $idType = 'broadcaster_id',
        array $dateRange = [],
        array $cursor = [],
        int $first = 20,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        $allowedIdTypes = ['id', 'game_id', 'broadcaster_id'];

        if (! in_array($idType, $allowedIdTypes)) {
            throw new Exception(sprintf('Invalid ID type. Given "%s", allowed are: %s', $idType, implode(',', $allowedIdTypes)));
        }

        $uri = new Uri(self::BASE_API_URL . 'clips');
        $query = self::buildQueryString([
                $idType => $id,
                'started_at' => $dateRange['started_at'] ?
                    (new DateTimeImmutable('- ' . $dateRange['started_at'] . ' months'))->format(DateTimeInterface::RFC3339) : null,
                'ended_at' => $dateRange['ended_at'] ?
                    (new DateTimeImmutable('- ' . $dateRange['ended_at'] . ' months'))->format(DateTimeInterface::RFC3339) :
                    (new DateTimeImmutable())->format(DateTimeInterface::RFC3339),
                'after' => $cursor['after'] ?? null,
                'before' => $cursor['before'] ?? null,
                'first' => $first,
            ]
        );

        return $this->sendRequest($uri->withQuery($query), Clip::class, $accessToken);
    }

    /**
     * @param array                     $ids
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponse
     * @throws ClientExceptionInterface
     */
    public function getChannelInformation(array $ids, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        $uri = new Uri(self::BASE_API_URL . 'channels');
        $query = self::buildQueryString(['broadcaster_id' => $ids]);

        return $this->sendRequest($uri->withQuery($query), ChannelInformation::class, $accessToken);
    }

    /**
     * @param array|null                $logins
     * @param array                     $ids
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponse
     * @throws ClientExceptionInterface
     */
    public function getUsers(array $logins = null, array $ids = [], AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        if (count($ids) === 0 && count($logins) === 0) {
            throw new RuntimeException('You need to specify at least one "id" or "login"');
        }

        $uri = new Uri(self::BASE_API_URL . 'users');
        $query = self::buildQueryString(['id' => $ids, 'login' => $logins]);

        return $this->sendRequest($uri->withQuery($query), TwitchUser::class, $accessToken);
    }

    public function getUsersFollows(
        string $fromId = '',
        string $toId = '',
        ?string $cursor = '',
        ?int $first = 20,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        if (! $fromId && ! $toId) {
            throw new RuntimeException('At minimum, fromId or toId must be provided for a query to be valid.');
        }

        $uri = new Uri(self::BASE_API_URL . 'users/follows');
        $query = self::buildQueryString(['to_id' => $toId, 'from_id' => $fromId, 'after' => $cursor, 'first' => $first]);

        return $this->sendRequest($uri->withQuery($query), Follows::class, $accessToken);
    }

    public function getBroadcasterSubscriptions(
        string $broadcasterId,
        ?string $userId = null,
        ?string $after = null,
        int $first = 20,
        ?AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        $uri = new Uri(self::BASE_API_URL . 'subscriptions');
        $query = self::buildQueryString(['broadcaster_id' => $broadcasterId, 'user_id' => $userId, 'after' => $after, 'first' => $first]);

        return $this->sendRequest($uri->withQuery($query), Subscription::class, $accessToken);
    }

    public function createStreamScheduleSegment(string $broadcasterId, array $segment, AccessTokenInterface $accessToken):
    TwitchResponseInterface {
        $uri = new Uri(self::BASE_API_URL . 'schedule/segment');
        $query = self::buildQueryString(['broadcaster_id' => $broadcasterId]);

        return $this->sendRequest(
            $uri->withQuery($query),
            StreamSchedule::class,
            $accessToken,
            Request::METHOD_POST,
            $segment
        );
    }

    public function deleteStreamScheduleSegment(
        string $broadcasterId,
        array $segment,
        AccessTokenInterface $accessToken
    ): void {
        $uri = new Uri(self::BASE_API_URL . 'schedule/segment');
        $query = self::buildQueryString(['broadcaster_id' => $broadcasterId, 'id' => $segment['id']]);

        $this->sendRequest($uri->withQuery($query), null, $accessToken, Request::METHOD_DELETE);
    }

    public function updateStreamScheduleSegment(
        string $broadcasterId,
        string $id,
        array $segment,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        $uri = new Uri(self::BASE_API_URL . 'schedule/segment');
        $query = self::buildQueryString(['broadcaster_id' => $broadcasterId, 'id' => $id]);

        return $this->sendRequest(
            $uri->withQuery($query),
            StreamSchedule::class,
            $accessToken,
            Request::METHOD_PATCH,
            $segment
        );
    }

    /**
     * @throws ClientExceptionInterface
     * @throws JsonException
     */
    protected function sendRequest(
        UriInterface $uri,
        ?string $type = null,
        ?AccessTokenInterface $accessToken = null,
        ?string $method = 'GET',
        ?array $body = []
    ): ?TwitchResponseInterface {
        if (! $accessToken) {
            $accessToken = $this->getAccessToken('client_credentials');
        }

        $request = $this->requestFactory->createRequest($method, $uri);
        $request = $request
            ->withHeader('Authorization', ucfirst($accessToken->getValues()['token_type']) . ' ' . $accessToken->getToken())
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Client-ID', $this->options['clientId']);

        if (! empty($body)) {
            $request = $request->withBody($this->streamFactory->createStream($this->serializer->serialize($body, 'json')));
        }

        $response = $this->client->sendRequest($request);

        if ($response->getStatusCode() >= 400) {
            $error = json_decode($response->getBody(), false, 512, JSON_THROW_ON_ERROR);
            throw new InvalidArgumentException(sprintf('Error from API: "(%s): %s"', $error->error, $error->message));
        }

        if ($response->getStatusCode() === 204) {
            return null;
        }

        return $this->serializer->deserialize(
            $response->getBody(),
            TwitchResponse::class . ($type ? ("<${type}>") : ''),
            'json',
        );
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
}
