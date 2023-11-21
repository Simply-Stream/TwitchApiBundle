<?php

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Tests\Helix\EventSub;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\MapperBuilder;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Nyholm\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use SimplyStream\TwitchApi\Helix\Api\EventSubApi;
use SimplyStream\TwitchApi\Helix\EventSub\EventSubService;
use SimplyStream\TwitchApi\Helix\EventSub\Exceptions\ChallengeMissingException;
use SimplyStream\TwitchApi\Helix\EventSub\Exceptions\InvalidSignatureException;
use SimplyStream\TwitchApi\Helix\EventSub\Exceptions\MissingHeaderException;
use SimplyStream\TwitchApi\Helix\EventSub\Exceptions\UnsupportedEventException;
use SimplyStream\TwitchApi\Helix\Models\EventSub\Condition\StreamOnlineCondition;
use SimplyStream\TwitchApi\Helix\Models\EventSub\EventResponse;
use SimplyStream\TwitchApi\Helix\Models\EventSub\EventSubResponse;
use SimplyStream\TwitchApi\Helix\Models\EventSub\Subscriptions\StreamOnlineSubscription;
use SimplyStream\TwitchApi\Helix\Models\EventSub\Transport;

/**
 * @package SimplyStream\TwitchApiBundle\Tests\Helix\EventSub
 *
 * @covers  \SimplyStream\TwitchApi\Helix\EventSub\EventSubService
 */
class EventSubServiceTest extends TestCase
{
    public function testSubscribeToEventSub() {
        $streamOnlineSubscription = new StreamOnlineSubscription(
            ['broadcasterUserId' => '12345678'],
            new Transport('webhook', 'https://localhost/check/twitch', '1234567890')
        );

        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $eventSubApiMock
            ->expects($this->once())
            ->method('createEventSubSubscription')
            ->willReturn(new EventSubResponse([new StreamOnlineSubscription(
                ['broadcasterUserId' => '12345678'],
                new Transport('webhook', 'https://localhost/check/twitch', '1234567890'),
                '5d199911-d650-4482-96cb-8c8edfab377e',
                'webhook_callback_verification_pending',
                new \DateTimeImmutable('2023-11-11T19:26:28.916086425Z'),
                'stream.online',
                '1'
            )], 1, 0, 10_000));

        $mapperBuilder = new MapperBuilder();
        $accessTokenMock = $this->createMock(AccessTokenInterface::class);

        $sut = new EventSubService($eventSubApiMock, $mapperBuilder, ['webhook' => ['secret' => '1234567890']]);
        $response = $sut->subscribe($streamOnlineSubscription, $accessTokenMock);

        $this->assertInstanceOf(EventSubResponse::class, $response);
        $this->assertIsArray($response->getData());

        /** @var StreamOnlineSubscription $subscription */
        foreach ($response->getData() as $subscription) {
            $this->assertSame('5d199911-d650-4482-96cb-8c8edfab377e', $subscription->getId());
            $this->assertSame('webhook_callback_verification_pending', $subscription->getStatus());
            $this->assertSame('stream.online', $subscription->getType());
            $this->assertSame('1', $subscription->getVersion());
            $this->assertEquals(new \DateTimeImmutable('2023-11-11T19:26:28.916086425Z'), $subscription->getCreatedAt());
            $this->assertEquals(new StreamOnlineCondition('12345678'), $subscription->getCondition());
        }
    }

    public function testThrowsEventOnMappingError() {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('');

        $mappingErrorMock = $this->createMock(MappingError::class);

        $streamOnlineSubscription = new StreamOnlineSubscription(
            ['broadcasterUserId' => '12345678'],
            new Transport('webhook', 'https://localhost/check/twitch', '1234567890')
        );
        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $eventSubApiMock
            ->expects($this->once())
            ->method('createEventSubSubscription')
            ->willThrowException($mappingErrorMock);

        $mapperBuilder = new MapperBuilder();
        $accessTokenMock = $this->createMock(AccessTokenInterface::class);

        $sut = new EventSubService($eventSubApiMock, $mapperBuilder, ['webhook' => ['secret' => '1234567890']]);
        $sut->subscribe($streamOnlineSubscription, $accessTokenMock);
    }

    public function testVerifySignature() {
        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects($this->exactly(3))
            ->method('getHeader')
            ->willReturnCallback(function (string $headerName) {
                return match ($headerName) {
                    'Twitch-Eventsub-Message-Signature' => ['sha256=9a349e04167b42b4b48f8f5a4bbee83479c15d506b746d8efcb6bf17ba6cf846'],
                    'Twitch-Eventsub-Message-Id' => ['1234-123456-123456-1234'],
                    'Twitch-Eventsub-Message-Timestamp' => [(new \DateTimeImmutable('2023-11-14 18:00Z'))->format(DATE_RFC3339_EXTENDED)]
                };
            });

        $requestMock
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(Stream::create(''));

        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $sut = new EventSubService($eventSubApiMock, new MapperBuilder(), ['webhook' => ['secret' => '1234567890']]);
        $result = $sut->verifySignature($requestMock, '1234567890');

        $this->assertTrue($result);
    }

    public function testVerifySignatureThrowsInvalidateSignatureError() {
        $receivedSignature = 'sha256=9a349e04167b42b4b48f8f5a4bbee83479c15d506b746d8efcb6bf17ba6cf847';
        $signature = 'sha256=9a349e04167b42b4b48f8f5a4bbee83479c15d506b746d8efcb6bf17ba6cf846';

        $this->expectException(InvalidSignatureException::class);
        $this->expectExceptionMessage(sprintf('Signature is invalid. Got "%s" expected "%s"', $receivedSignature, $signature));

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects($this->exactly(3))
            ->method('getHeader')
            ->willReturnCallback(function (string $headerName) use ($receivedSignature) {
                return match ($headerName) {
                    'Twitch-Eventsub-Message-Signature' => [$receivedSignature],
                    'Twitch-Eventsub-Message-Id' => ['1234-123456-123456-1234'],
                    'Twitch-Eventsub-Message-Timestamp' => [(new \DateTimeImmutable('2023-11-14 18:00Z'))->format(DATE_RFC3339_EXTENDED)]
                };
            });

        $requestMock
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(Stream::create(''));

        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $sut = new EventSubService($eventSubApiMock, new MapperBuilder(), ['webhook' => ['secret' => '1234567890']]);
        $sut->verifySignature($requestMock, '1234567890');
    }

    public function testVerifySignatureThrowsMissingHeadersException() {
        $this->expectException(MissingHeaderException::class);
        $this->expectExceptionMessage('Signature, Timestamp or MessageID headers empty');

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects($this->exactly(3))
            ->method('getHeader')
            ->willReturnCallback(function (string $headerName) {
                return match ($headerName) {
                    'Twitch-Eventsub-Message-Signature' => ['9a349e04167b42b4b48f8f5a4bbee83479c15d506b746d8efcb6bf17ba6cf846'],
                    'Twitch-Eventsub-Message-Id' => [''],
                    'Twitch-Eventsub-Message-Timestamp' => [(new \DateTimeImmutable('2023-11-14 18:00Z'))->format(DATE_RFC3339_EXTENDED)]
                };
            });

        $requestMock
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(Stream::create(''));

        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $sut = new EventSubService($eventSubApiMock, new MapperBuilder(), ['webhook' => ['secret' => '1234567890']]);
        $sut->verifySignature($requestMock, '1234567890');
    }

    public function testHandleSubscriptionCallback() {
        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects($this->exactly(4))
            ->method('getHeader')
            ->willReturnCallback(function (string $headerName) {
                return match ($headerName) {
                    'Twitch-Eventsub-Message-Signature' => ['sha256=69927a96840a182b64f51e7d24e52147322b71ed03515ffcab78a1f54c9abd5e'],
                    'Twitch-Eventsub-Message-Id' => ['1234-123456-123456-1234'],
                    'Twitch-Eventsub-Message-Timestamp' => [(new \DateTimeImmutable('2023-11-14 18:00Z'))->format(DATE_RFC3339_EXTENDED)],
                    'Twitch-Eventsub-Subscription-Type' => ['stream.online']
                };
            });

        $requestMock
            ->expects($this->exactly(2))
            ->method('getBody')
            ->willReturn(Stream::create(<<<'JSON'
{
    "challenge": "pogchamp-kappa-360noscope-vohiyo",
    "subscription": {
        "id": "1234-123456-123456-1234",
        "type": "stream.online",
        "version": "1",
        "status": "webhook_callback_verification_pending",
        "cost": 0,
        "condition": {
            "broadcaster_user_id": "1337"
        },
         "transport": {
            "method": "webhook",
            "callback": "https://example.com/webhooks/callback"
        },
        "created_at": "2023-11-14T18:00:00.000000000Z"
    },
    "event": {
        "id": "9001",
        "broadcaster_user_id": "1337",
        "broadcaster_user_login": "cool_user",
        "broadcaster_user_name": "Cool_User",
        "type": "live",
        "started_at": "2020-10-11T10:11:12.123Z"
    }
}
JSON
            ));

        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $sut = new EventSubService($eventSubApiMock, new MapperBuilder(), ['webhook' => ['secret' => '1234567890']]);
        $eventResponse = $sut->handleSubscriptionCallback($requestMock, '1234567890');

        $this->assertInstanceOf(EventResponse::class, $eventResponse);
        $this->assertSame('pogchamp-kappa-360noscope-vohiyo', $eventResponse->getChallenge());
    }

    public function testHandleSubscriptionCallbackMissingChallenge() {
        $this->expectException(ChallengeMissingException::class);
        $this->expectExceptionMessage('Challenge is missing');

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects($this->exactly(4))
            ->method('getHeader')
            ->willReturnCallback(function (string $headerName) {
                return match ($headerName) {
                    'Twitch-Eventsub-Message-Signature' => ['sha256=4855ea43cbba506421e451f99712ba86250afa3f69d5022f2fe8e6c94719440b'],
                    'Twitch-Eventsub-Message-Id' => ['1234-123456-123456-1234'],
                    'Twitch-Eventsub-Message-Timestamp' => [(new \DateTimeImmutable('2023-11-14 18:00Z'))->format(DATE_RFC3339_EXTENDED)],
                    'Twitch-Eventsub-Subscription-Type' => ['stream.online']
                };
            });

        $requestMock
            ->expects($this->exactly(2))
            ->method('getBody')
            ->willReturn(Stream::create(<<<'JSON'
{
    "subscription": {
        "id": "1234-123456-123456-1234",
        "type": "stream.online",
        "version": "1",
        "status": "webhook_callback_verification_pending",
        "cost": 0,
        "condition": {
            "broadcaster_user_id": "1337"
        },
         "transport": {
            "method": "webhook",
            "callback": "https://example.com/webhooks/callback"
        },
        "created_at": "2023-11-14T18:00:00.000000000Z"
    },
    "event": {
        "id": "9001",
        "broadcaster_user_id": "1337",
        "broadcaster_user_login": "cool_user",
        "broadcaster_user_name": "Cool_User",
        "type": "live",
        "started_at": "2020-10-11T10:11:12.123Z"
    }
}
JSON
            ));

        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $sut = new EventSubService($eventSubApiMock, new MapperBuilder(), ['webhook' => ['secret' => '1234567890']]);
        $sut->handleSubscriptionCallback($requestMock, '1234567890');
    }

    public function testHandleSubscriptionCallbackThrowsExceptionForUnknownType() {
        $this->expectException(UnsupportedEventException::class);
        $this->expectExceptionMessage('The received event "stream.inline" is not supported');

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects($this->exactly(4))
            ->method('getHeader')
            ->willReturnCallback(function (string $headerName) {
                return match ($headerName) {
                    'Twitch-Eventsub-Message-Signature' => ['sha256=9a349e04167b42b4b48f8f5a4bbee83479c15d506b746d8efcb6bf17ba6cf846'],
                    'Twitch-Eventsub-Message-Id' => ['1234-123456-123456-1234'],
                    'Twitch-Eventsub-Message-Timestamp' => [(new \DateTimeImmutable('2023-11-14 18:00Z'))->format(DATE_RFC3339_EXTENDED)],
                    'Twitch-Eventsub-Subscription-Type' => ['stream.inline']
                };
            });

        $requestMock
            ->expects($this->once())
            ->method('getBody')
            ->willReturn(Stream::create(''));

        $eventSubApiMock = $this->createMock(EventSubApi::class);
        $sut = new EventSubService($eventSubApiMock, new MapperBuilder(), ['webhook' => ['secret' => '1234567890']]);
        $sut->handleSubscriptionCallback($requestMock, '1234567890');
    }
}
