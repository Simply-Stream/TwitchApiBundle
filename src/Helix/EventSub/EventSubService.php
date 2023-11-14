<?php declare(strict_types=1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Object\DynamicConstructor;
use CuyZ\Valinor\Mapper\Source\Exception\InvalidSource;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\Mapper\TreeMapper;
use CuyZ\Valinor\MapperBuilder;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Message\RequestInterface;
use SimplyStream\TwitchApiBundle\Helix\Api\EventSubApi;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\ChallengeMissingException;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidSignatureException;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\MissingHeaderException;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\UnsupportedEventException;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\EventResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\EventInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\EventSubResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\PaginatedEventSubResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions\Subscriptions;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

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

    protected TreeMapper $mapper;

    /**
     * @param EventSubApi   $eventSubApi
     * @param MapperBuilder $mapperBuilder
     * @param array         $options
     */
    public function __construct(
        protected EventSubApi $eventSubApi,
        MapperBuilder $mapperBuilder,
        protected array $options
    ) {
        $this->mapper = $mapperBuilder
            ->registerConstructor(
                #[DynamicConstructor]
                function (string $className, array $value): Subscription {
                    $type = Subscriptions::MAP[$value['type']];

                    return new $type(
                        $value['condition'],
                        new Transport(...$value['transport']),
                        $value['id'],
                        $value['status'],
                        new \DateTimeImmutable($value['createdAt']),
                    );
                }
            )
            ->allowPermissiveTypes()
            ->mapper();
    }

    /**
     * Create a subscription on EventSub API
     *
     * @template T
     *
     * @param Subscription              $subscription
     * @param AccessTokenInterface|null $accessToken
     *
     * @return EventSubResponse<T>
     * @throws \JsonException
     */
    public function subscribe(Subscription $subscription, AccessTokenInterface $accessToken = null): EventSubResponse {
        try {
            $response = $this->eventSubApi->createEventSubSubscription($subscription, $accessToken);
        } catch (MappingError $e) {
            throw new \RuntimeException($e->getMessage());
        }

        return $response;
    }

    /**
     * Unsubscribes from a subscription with $subscriptionId
     *
     * @param string $subscriptionId
     *
     * @return void
     * @throws \JsonException
     */
    public function unsubscribe(string $subscriptionId): void {
        $this->eventSubApi->deleteEventSubSubscription($subscriptionId);
    }

    /**
     * Returns all current subscriptions from Twitch
     *
     * @return PaginatedEventSubResponse
     * @throws \JsonException
     */
    public function getSubscriptions(): PaginatedEventSubResponse {
        return $this->eventSubApi->getEventSubSubscriptions();
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
     * @throws InvalidSignatureException
     * @throws InvalidSource
     * @throws MappingError
     * @throws UnsupportedEventException
     * @throws ChallengeMissingException
     */
    public function handleSubscriptionCallback(RequestInterface $request, ?string $secret = null): EventResponse {
        $this->verifySignature($request, $secret);
        $type = $this->extractType($request);

        /** @var EventResponse $eventResponse */
        $eventResponse = $this->mapper->map(
            sprintf('%s<%s, %s>', EventResponse::class, Subscriptions::MAP[$type], EventInterface::AVAILABLE_EVENTS[$type]),
            Source::json((string)$request->getBody())->camelCaseKeys()
        );

        if ($eventResponse->getSubscription()->getStatus() === self::WEBHOOK_CALLBACK_VERIFICATION_PENDING && ! $eventResponse->getChallenge()) {
            throw new ChallengeMissingException('Challenge is missing');
        }

        return $eventResponse;
    }

    /**
     * Verify signature sent in Twitch request to subscription verification callback
     *
     * @param RequestInterface $request
     * @param string|null      $secret
     *
     * @return true
     * @throws InvalidSignatureException
     */
    public function verifySignature(RequestInterface $request, ?string $secret = null): true {
        $content = (string)$request->getBody();
        $receivedSignature = current($request->getHeader(self::WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER));

        $messageId = current($request->getHeader(self::WEBHOOK_CALLBACK_MESSAGE_ID));
        $timestamp = current($request->getHeader(self::WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP));

        if (! $receivedSignature || ! $timestamp || ! $messageId) {
            throw new MissingHeaderException('Signature, Timestamp or MessageID headers empty');
        }

        $signature = 'sha256=' . \hash_hmac('sha256', $messageId . $timestamp . $content, $secret ?? $this->options['webhook']['secret']);

        if ($signature !== $receivedSignature) {
            throw new InvalidSignatureException(sprintf('Signature is invalid. Got "%s" expected "%s"', $receivedSignature, $signature));
        }

        return true;
    }

    /**
     * Extract the event type from headers. Throws exception if event is not supported.
     *
     * @param RequestInterface $request
     *
     * @return string
     * @throws UnsupportedEventException
     */
    protected function extractType(RequestInterface $request): string {
        $type = \current($request->getHeader(self::WEBHOOK_CALLBACK_EVENT_TYPE));
        if (! $type || ! \array_key_exists($type, EventInterface::AVAILABLE_EVENTS)) {
            throw new UnsupportedEventException(sprintf('The received event "%s" is not supported', $type));
        }

        return $type;
    }
}
