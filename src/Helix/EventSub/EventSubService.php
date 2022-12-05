<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub;

use JMS\Serializer\SerializerInterface;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use SimplyStream\TwitchApiBundle\Helix\Api\ApiClient;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Token\Storage\TokenStorageInterface;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions\Conditions;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\EventResponse;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events\Events;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Subscription;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidAccessTokenException;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidSignatureException;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\UnsupportedEventException;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub
 */
class EventSubService
{
    public const WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER = 'Twitch-Eventsub-Message-Signature';
    public const WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP = 'Twitch-Eventsub-Message-Timestamp';
    public const WEBHOOK_CALLBACK_EVENT_TYPE = 'Twitch-Eventsub-Subscription-Type';
    public const WEBHOOK_CALLBACK_MESSAGE_ID = 'Twitch-Eventsub-Message-Id';

    public const WEBHOOK_ENABLED = 'enabled';
    public const WEBHOOK_CALLBACK_VERIFICATION = 'webhook_callback_verification';
    public const WEBHOOK_CALLBACK_VERIFICATION_PENDING = 'webhook_callback_verification_pending';
    public const WEBHOOK_CALLBACK_VERIFICATION_FAILED = 'webhook_callback_verification_failed';
    public const WEBHOOK_NOTIFICATION_FAILURES_EXCEEDED = 'notification_failures_exceeded';
    public const WEBHOOK_AUTHORIZATION_REVOKED = 'authorization_revoked';
    public const WEBHOOK_USER_REVOKED = 'user_removed';

    /** @var string */
    public const API_URL = ApiClient::BASE_API_URL . 'eventsub/subscriptions';

    /** @var TokenStorageInterface|null */
    protected ?TokenStorageInterface $tokenStorage;

    /**
     * @param ClientInterface         $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface  $streamFactory
     * @param SerializerInterface     $serializer
     * @param TwitchProvider          $twitch
     * @param array                   $options
     */
    public function __construct(
        protected ClientInterface $httpClient,
        protected RequestFactoryInterface $requestFactory,
        protected StreamFactoryInterface $streamFactory,
        protected SerializerInterface $serializer,
        protected TwitchProvider $twitch,
        protected array $options
    ) {
    }

    /**
     * @param TokenStorageInterface $tokenStorage
     *
     * @return EventSubService
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage): EventSubService
    {
        $this->tokenStorage = $tokenStorage;

        return $this;
    }

    /**
     * @return string
     */
    protected function getRequestUri(): string
    {
        return self::API_URL;
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

    /**
     * Create a subscription on EventSub API
     *
     * @param Subscription              $subscription
     * @param AccessTokenInterface|null $accessToken
     *
     * @return ResponseInterface
     */
    public function subscribe(Subscription $subscription, AccessTokenInterface $accessToken = null): ResponseInterface
    {
        try {
            if (! $accessToken) {
                $accessToken = $this->getAccessToken('client_credentials');
            }

            if (! $subscription->getTransport()->getSecret()) {
                $subscription->getTransport()->setSecret($this->options['webhook']['secret']);
            }

            $body = $this->streamFactory->createStream(
                $this->serializer->serialize(
                    $subscription,
                    'json'
                )
            );

            $request = $this->requestFactory->createRequest('POST', $this->getRequestUri());
            $request = $request->withBody($body)
                ->withHeader('Authorization', ucfirst($accessToken->getValues()['token_type']) . ' ' . $accessToken->getToken())
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Client-ID', $this->options['clientId']);

            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            // @TODO: Handle exception properly (not generic)
            throw new \RuntimeException($e->getMessage());
        }

        // @TODO: Denormalize?
        return $response;
    }

    /**
     * Verify signature sent in Twitch request to subscription verification callback
     *
     * @param RequestInterface $request
     * @param string|null      $secret
     *
     * @return bool
     * @throws InvalidSignatureException
     */
    public function verifySignature(RequestInterface $request, ?string $secret = null): bool
    {
        $content = (string)$request->getBody();
        $receivedSignature = current($request->getHeader(self::WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER));

        $messageId = current($request->getHeader(self::WEBHOOK_CALLBACK_MESSAGE_ID));
        // @TODO: Check if timestamp is not older than 10 minutes
        $timestamp = current($request->getHeader(self::WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP));

        if (! $receivedSignature || ! $timestamp || ! $messageId) {
            throw new \InvalidArgumentException('Signature, Timestamp or MessageID headers empty');
        }

        $signature = 'sha256=' . \hash_hmac('sha256', $messageId . $timestamp . $content, $secret ?? $this->options['webhook']['secret']);

        if ($signature !== $receivedSignature) {
            throw new InvalidSignatureException(sprintf('Signature is invalid. Got "%s" expected "%s"', $receivedSignature, $signature));
        }

        return true;
    }

    /**
     * Unsubscribes from a subscription with $subscriptionId
     *
     * @param string $subscriptionId
     *
     * @return ResponseInterface
     */
    public function unsubscribe(string $subscriptionId): ResponseInterface
    {
        try {
            $accessToken = $this->getAccessToken('client_credentials');
            $request = $this->requestFactory->createRequest('DELETE',
                $this->getRequestUri() . '?' . http_build_query(['id' => $subscriptionId]));
            $request = $request
                ->withHeader('Authorization', ucfirst($accessToken->getValues()['token_type']) . ' ' . $accessToken->getToken())
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Client-ID', $this->options['clientId']);

            return $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            // @TODO: Better exception handling (not generic)
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Returns all current subscriptions from Twitch
     *
     * @return array
     * @throws \JsonException
     */
    public function getSubscriptions(): array
    {
        try {
            $accessToken = $this->getAccessToken('client_credentials');

            $request = $this->requestFactory->createRequest('GET', $this->getRequestUri());
            $request = $request
                ->withHeader('Authorization', ucfirst($accessToken->getValues()['token_type']) . ' ' . $accessToken->getToken())
                ->withHeader('Content-Type', 'application/json')
                ->withHeader('Client-ID', $this->options['clientId']);

            $response = $this->httpClient->sendRequest($request);

            // @TODO: Replace with Collection wrapper? Denormalize?
            return \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR) ?? [];
        } catch (ClientExceptionInterface $e) {
            // @TODO: Better exception handling (not generic)
            throw new \RuntimeException($e->getMessage());
        }
    }

    /**
     * Extract the event type from headers. Throws exception if event is not supported.
     *
     * @param RequestInterface $request
     *
     * @return string
     * @throws UnsupportedEventException
     */
    protected function extractType(RequestInterface $request): string
    {
        $type = \current($request->getHeader(self::WEBHOOK_CALLBACK_EVENT_TYPE));
        if (! $type || ! \array_key_exists($type, Events::AVAILABLE_EVENTS)) {
            throw new UnsupportedEventException(sprintf('The received event "%s" is not supported', $type));
        }

        return $type;
    }

    /**
     * Handles the callback send by Twitch. Will return raw json if Twitch send a verification request or maps the response to an
     * EventInterface. Will throw an exception on unsupported events or invalid signature.
     * Note: Do not forget to respond to Twitch with the raw challenge, that'll be provided in this methods response.
     *
     * @param RequestInterface $request
     * @param string|null      $secret
     *
     * @return EventResponse
     *
     * @throws InvalidSignatureException
     * @throws UnsupportedEventException
     * @throws \JsonException|\Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function handleSubscriptionCallback(RequestInterface $request, ?string $secret = null): EventResponse
    {
        $this->verifySignature($request, $secret);
        $type = $this->extractType($request);

        /** @var EventResponse $eventResponse */
        $eventResponse = $this->serializer->deserialize(
            (string)$request->getBody(),
            sprintf('%s<%s, %s>', EventResponse::class, Conditions::CONDITIONS[$type], Events::AVAILABLE_EVENTS[$type]),
            'json'
        );

        if ($eventResponse->getSubscription()->getStatus() === self::WEBHOOK_CALLBACK_VERIFICATION_PENDING && ! $eventResponse->getChallenge()) {
            throw new \RuntimeException('Challenge is missing');
        }

        return $eventResponse;
    }
}
