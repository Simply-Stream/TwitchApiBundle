<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub;

use JMS\Serializer\SerializerInterface as JMSSerializerInterfaceAlias;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Message\RequestInterface;
use SimplyStream\TwitchApiBundle\Helix\Api\EventSubApi;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions\Conditions;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\EventResponse;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events\Events;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Subscription;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidSignatureException;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\UnsupportedEventException;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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

    protected NormalizerInterface $normalizer;

    /**
     * @param EventSubApi                 $eventSubApi
     * @param JMSSerializerInterfaceAlias $jmsSerializer
     * @param TwitchProvider              $twitch
     * @param array                       $options
     */
    public function __construct(
        protected EventSubApi $eventSubApi,
        protected JMSSerializerInterfaceAlias $jmsSerializer,
        protected TwitchProvider $twitch,
        protected array $options
    ) {
        $this->normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
    }

    /**
     * Create a subscription on EventSub API
     *
     * @param Subscription              $subscription
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \RuntimeException
     */
    public function subscribe(Subscription $subscription, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        try {
            if (! $subscription->getTransport()->getSecret()) {
                $subscription->getTransport()->setSecret($this->options['webhook']['secret']);
            }

            $response = $this->eventSubApi->createEventSubSubscription(
                $this->jmsSerializer->toArray($subscription, type: Subscription::class . '<' . $subscription->getCondition()::class . '>'),
                $subscription->getCondition()::class,
                $accessToken
            );
        } catch (\JsonException $e) {
            throw new \RuntimeException($e->getMessage());
        }

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
     * @return void
     * @throws \JsonException
     */
    public function unsubscribe(string $subscriptionId): void
    {
        $this->eventSubApi->deleteEventSubSubscription($subscriptionId);
    }

    /**
     * Returns all current subscriptions from Twitch
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getSubscriptions(): TwitchResponseInterface
    {
        return $this->eventSubApi->getEventSubSubscriptions();
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
     */
    public function handleSubscriptionCallback(RequestInterface $request, ?string $secret = null): EventResponse
    {
        $this->verifySignature($request, $secret);
        $type = $this->extractType($request);

        /** @var EventResponse $eventResponse */
        $eventResponse = $this->jmsSerializer->deserialize(
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
