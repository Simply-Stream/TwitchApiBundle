<?php

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Tests\Helix\EventSub;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\EventResponse;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Subscription;
use SimplyStream\TwitchApiBundle\Helix\EventSub\EventSubService;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidAccessTokenException;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions\InvalidSignatureException;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\StreamOnlineEvent;
use Symfony\Component\Serializer\Serializer;

/**
 * @package SimplyStream\TwitchApiBundle\Tests\Helix\EventSub
 *
 * @covers  \SimplyStream\TwitchApiBundle\Helix\EventSub\EventSubService
 */
class EventSubServiceTest extends TestCase
{
    public function testSuccessfulSubscription(): void
    {
        $this->markTestSkipped('@TODO: Need to rework tests due to final methods in Serializer');

        $subscription = new Subscription(new ChannelFollowCondition(['broadcasterUserId' => '123456']), new Transport('https://localhost'));

        $streamFactoryMock = $this->createMock(StreamFactoryInterface::class);

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects(self::once())
            ->method('withBody')
            ->willReturn($requestMock);

        $responseMock = $this->createMock(ResponseInterface::class);

        $httpClientMock = $this->createMock(ClientInterface::class);
        $httpClientMock
            ->expects(self::once())
            ->method('sendRequest')
            ->with($requestMock)
            ->willReturn($responseMock);

        $requestMock
            ->expects(self::exactly(3))
            ->method('withHeader')
            ->withConsecutive(
                [self::equalTo('Authorization'), self::equalTo('Bearer asdfghjkl')],
                [self::equalTo('Content-Type'), self::equalTo('application/json')],
                [self::equalTo('Client-ID'), self::equalTo('1234567890')],
            )
            ->willReturn($requestMock);

        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $requestFactoryMock
            ->method('createRequest')
            ->with('POST', 'https://api.twitch.tv/helix/eventsub/subscriptions')
            ->willReturn($requestMock);

        $serializerMock = $this->createMock(Serializer::class);
        $serializerMock
            ->method('serialize')
            ->with($subscription, 'json')
            ->willReturn('{"type":"channel.follow", "version": "1", "condition": {"broadcaster_user_id": "123456}, "transport": {"method": "webhook", "callback": "https://localhost", "secret": "secretencodingstring!}}');

        $accessTokenMock = $this->createMock(AccessTokenInterface::class);
        $accessTokenMock
            ->method('getValues')
            ->willReturn(['token_type' => 'bearer']);
        $accessTokenMock
            ->method('getToken')
            ->willReturn('asdfghjkl');

        $twitchMock = $this->createMock(TwitchProvider::class);
        $twitchMock
            ->method('getAccessToken')
            ->willReturn($accessTokenMock);

        $sut = new EventSubService(
            $httpClientMock,
            $requestFactoryMock,
            $streamFactoryMock,
            $serializerMock,
            $twitchMock,
            [
                'clientId' => '1234567890',
                'webhook' => ['secret' => 'secretencodingstring!'],
            ]
        );

        $sut->subscribe($subscription);
    }

    public function testFailedAuthenticationOnSubscription(): void
    {
        $this->markTestSkipped('@TODO: Need to rework tests due to major changes');

        $this->expectException(InvalidAccessTokenException::class);
        $this->expectExceptionMessage('Invalid credentials');

        $secret = '1234567890';
        $subscription = new Subscription(new ChannelFollowCondition(['broadcasterUserId' => '123456']), new Transport('https://localhost'));

        $httpClientMock = $this->createMock(ClientInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $streamFactoryMock = $this->createMock(StreamFactoryInterface::class);
        $serializerMock = $this->createMock(Serializer::class);
        $twitchMock = $this->createMock(TwitchProvider::class);
        $twitchMock
            ->expects(self::once())
            ->method('getAccessToken')
            ->with('client_credentials')
            ->willThrowException(new IdentityProviderException('Invalid credentials', 403, []));

        $sut = new EventSubService(
            $httpClientMock,
            $requestFactoryMock,
            $streamFactoryMock,
            $serializerMock,
            $twitchMock,
            [
                'clientId' => '1234567890',
                'webhook' => ['secret' => $secret],
            ]
        );

        $sut->subscribe($subscription);
    }

    public function testValidSignature(): void
    {
        $this->markTestSkipped('@TODO: Need to rework tests due to major changes');

        $secret = '1234567890';
        $httpClientMock = $this->createMock(ClientInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $streamFactoryMock = $this->createMock(StreamFactoryInterface::class);
        $serializerMock = $this->createMock(Serializer::class);
        $twitchMock = $this->createMock(TwitchProvider::class);

        $requestBody = $this->createMock(StreamInterface::class);

        $request = $this->createMock(RequestInterface::class);
        $request
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($requestBody);

        $messageId = 'e76c6bd4-55c9-4987-8304-da1588d8988b';
        $timestamp = (new \DateTime())->format('Y-m-d\TH:i:s\.v\Z');
        $signature = 'sha256=' . \hash_hmac('sha256', $messageId . $timestamp . $requestBody, $secret);
        $request
            ->expects(self::exactly(3))
            ->method('getHeader')
            ->withConsecutive(
                [self::equalTo(EventSubService::WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER)],
                [self::equalTo(EventSubService::WEBHOOK_CALLBACK_MESSAGE_ID)],
                [self::equalTo(EventSubService::WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP)],
            )
            ->willReturn([$signature], [$messageId], [$timestamp]);

        $sut = new EventSubService(
            $httpClientMock,
            $requestFactoryMock,
            $streamFactoryMock,
            $serializerMock,
            $twitchMock,
            [
                'clientId' => '1234567890',
                'webhook' => ['secret' => $secret],
            ]
        );

        self::assertTrue($sut->verifySignature($request), 'Signature is invalid');
    }

    public function testInvalidSignature(): void
    {
        $this->markTestSkipped('@TODO: Need to rework tests due to major changes');

        $this->expectException(InvalidSignatureException::class);

        $secret = '1234567890';
        $httpClientMock = $this->createMock(ClientInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $streamFactoryMock = $this->createMock(StreamFactoryInterface::class);
        $serializerMock = $this->createMock(Serializer::class);
        $twitchMock = $this->createMock(TwitchProvider::class);

        $requestBody = $this->createMock(StreamInterface::class);
        $requestBody
            ->expects(self::once())
            ->method('__toString')
            ->willReturn('{"manipulated": "body"}');

        $request = $this->createMock(RequestInterface::class);
        $request
            ->expects(self::once())
            ->method('getBody')
            ->willReturn($requestBody);

        $messageId = 'e76c6bd4-55c9-4987-8304-da1588d8988b';
        $timestamp = (new \DateTime())->format('Y-m-d\TH:i:s\.v\Z');
        $signature = 'sha256=' . \hash_hmac('sha256', $messageId . $timestamp, $secret);
        $request
            ->expects(self::exactly(3))
            ->method('getHeader')
            ->withConsecutive(
                [self::equalTo(EventSubService::WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER)],
                [self::equalTo(EventSubService::WEBHOOK_CALLBACK_MESSAGE_ID)],
                [self::equalTo(EventSubService::WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP)],
            )
            ->willReturn([$signature], [$messageId], [$timestamp]);

        $sut = new EventSubService(
            $httpClientMock,
            $requestFactoryMock,
            $streamFactoryMock,
            $serializerMock,
            $twitchMock,
            [
                'clientId' => '1234567890',
                'webhook' => ['secret' => $secret],
            ]
        );

        $sut->verifySignature($request);
    }

    public function testValidStreamOnlineCallbackRequest(): void
    {
        $this->markTestSkipped('@TODO: Need to rework tests due to major changes');

        $body = <<<JSON
{
    "subscription": {
        "id": "11223344-5566-7788-99bf-d0090c0976d2",
        "status": "enabled",
        "type": "stream.online",
        "version": "1",
        "condition": {
            "broadcaster_user_id": "12345678"
        },
        "transport": {
            "method": "webhook",
            "callback": "https://localhost:8080/twitch/subscription/callback"
        },
        "created_at": "2021-04-18T10:20:25.117993567Z",
        "cost": 0
    },
    "event": {
        "id": "11111111111",
        "broadcaster_user_id": "12345678",
        "broadcaster_user_login": "test",
        "broadcaster_user_name": "test",
        "type": "live",
        "started_at": "2021-04-18T11:06:45Z"
    }
}
JSON;
        $secret = '1234567890';

        $httpClientMock = $this->createMock(ClientInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $streamFactoryMock = $this->createMock(StreamFactoryInterface::class);
        $twitchMock = $this->createMock(TwitchProvider::class);
        $eventMock = new StreamOnlineEvent();
        $eventMock
            ->setId('11111111111')
            ->setType('stream.online')
            ->setStartedAt(new \DateTime('2021-04-18T11:06:45Z'))
            ->setBroadcasterUserId('12345678')
            ->setBroadcasterUserLogin('test')
            ->setBroadcasterUserName('test');

        $subscriptionMock = $this->createMock(Subscription::class);

        $serializerMock = $this->createMock(Serializer::class);
        $serializerMock
            ->expects(self::exactly(2))
            ->method('denormalize')
            ->willReturnCallback(function ($body, $class, $type) use ($eventMock, $subscriptionMock) {
                if ($class === Subscription::class) {
                    return $subscriptionMock;
                }

                return $eventMock;
            });

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects(self::atLeastOnce())
            ->method('getBody')
            ->willReturn($body);

        $requestMock
            ->expects(self::exactly(4))
            ->method('getHeader')
            ->willReturnCallback(function ($headerName) {
                switch ($headerName) {
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER:
                        return ['sha256=8a7bbb2a1e8e7454491e3c0935675f528e9400d7ac8f15c730db09d2caaf8521'];
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_ID:
                        return ['guODBNx8dVAkMKTuV2jw4jcczoOYfLR1jplBd3VZwvg'];
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP:
                        return ['2021-04-18T11:07:57.173417683Z'];
                    case EventSubService::WEBHOOK_CALLBACK_EVENT_TYPE:
                        return ['stream.online'];
                }

                throw new \RuntimeException('Unexpected header required');
            });

        $sut = new EventSubService($httpClientMock, $requestFactoryMock, $streamFactoryMock, $serializerMock, $twitchMock, []);
        $event = $sut->handleSubscriptionCallback($requestMock, $secret);

        $subscriptionCallbackResult = new EventResponse($subscriptionMock, null, $eventMock);

        self::assertEquals($subscriptionCallbackResult, $event);
    }

    public function testValidStreamOfflineCallbackRequest(): void
    {
        $this->markTestSkipped('@TODO: Need to rework tests due to final methods in Serializer');

        $body = <<<JSON
{
    "subscription": {
        "id": "11111111-aaa1-123a-321a-d70f52373e87",
        "status": "enabled",
        "type": "stream.offline",
        "version": "1",
        "condition": {
           "broadcaster_user_id": "12345678"
        },
        "transport": {
            "method": "webhook",
            "callback": "https://localhost:8080/twitch/subscription/callback"
        },
        "created_at": "2021-04-25T10:57:09.602940144Z",
        "cost": 0
    },
    "event": {
        "broadcaster_user_id": "12345678",
        "broadcaster_user_login": "test",
        "broadcaster_user_name": "test"
    }
}
JSON;
        $secret = '1234567890';

        $httpClientMock = $this->createMock(ClientInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $streamFactoryMock = $this->createMock(StreamFactoryInterface::class);
        $twitchMock = $this->createMock(TwitchProvider::class);
        $eventMock = new StreamOnlineEvent();
        $eventMock
            ->setId('11111111111')
            ->setType('stream.offline')
            ->setStartedAt(new \DateTime('2021-04-18T11:06:45Z'))
            ->setBroadcasterUserId('12345678')
            ->setBroadcasterUserLogin('test')
            ->setBroadcasterUserName('test');

        $subscriptionMock = $this->createMock(Subscription::class);

        $serializerMock = $this->createMock(Serializer::class);
        $serializerMock
            ->expects(self::exactly(2))
            ->method('deserialize')
            ->willReturnCallback(function ($body, $class) use ($eventMock, $subscriptionMock) {
                if ($class === Subscription::class) {
                    return $subscriptionMock;
                }

                return $eventMock;
            });

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects(self::atLeastOnce())
            ->method('getBody')
            ->willReturn($body);

        $requestMock
            ->expects(self::exactly(4))
            ->method('getHeader')
            ->willReturnCallback(function ($headerName) {
                switch ($headerName) {
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER:
                        return ['sha256=207739ecffb1c13cc931332c16adbc08bcbcebdc2f72586e32068679a728b842'];
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_ID:
                        return ['guODBNx8dVAkMKTuV2jw4jcczoOYfLR1jplBd3VZwvg'];
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP:
                        return ['2021-04-25T10:57:09.602940144Z'];
                    case EventSubService::WEBHOOK_CALLBACK_EVENT_TYPE:
                        return ['stream.offline'];
                }

                throw new \RuntimeException('Unexpected header required');
            });

        $sut = new EventSubService($httpClientMock, $requestFactoryMock, $streamFactoryMock, $serializerMock, $twitchMock, []);
        $event = $sut->handleSubscriptionCallback($requestMock, $secret);

        $subscriptionCallbackResult = new EventResponse($subscriptionMock, $eventMock);

        self::assertEquals($subscriptionCallbackResult, $event);
    }

    public function testValidChannelFollowCallbackRequest(): void
    {
        $this->markTestSkipped('@TODO: Need to rework tests due to final methods in Serializer');

        $body = <<<JSON
{
    "subscription": {
        "id": "11111111-2222-3333-4444-c52bb30c2f64",
        "status": "enabled",
        "type": "channel.follow",
        "version": "1",
        "condition": {
            "broadcaster_user_id": "12345678"
        },
        "transport": {
            "method": "webhook",
            "callback": "https://localhost:8080/twitch/subscription/callback"
        },
        "created_at": "2021-04-25T10:46:54.241081668Z",
        "cost": 0
    },
    "event": {
        "user_id": "87654321",
        "user_login": "follower",
        "user_name": "follower",
        "broadcaster_user_id": "12345678",
        "broadcaster_user_login": "test",
        "broadcaster_user_name": "test",
        "followed_at": "2021-04-25T11:42:04.950424406Z"
    }
}
JSON;
        $secret = '1234567890';

        $httpClientMock = $this->createMock(ClientInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $streamFactoryMock = $this->createMock(StreamFactoryInterface::class);
        $twitchMock = $this->createMock(TwitchProvider::class);
        $eventMock = new StreamOnlineEvent();
        $eventMock
            ->setId('11111111111')
            ->setType('stream.offline')
            ->setStartedAt(new \DateTime('2021-04-18T11:06:45Z'))
            ->setBroadcasterUserId('12345678')
            ->setBroadcasterUserLogin('test')
            ->setBroadcasterUserName('test');

        $subscriptionMock = $this->createMock(Subscription::class);

        $serializerMock = $this->createMock(Serializer::class);
        $serializerMock
            ->expects(self::exactly(2))
            ->method('deserialize')
            ->willReturnCallback(function ($body, $class, $type) use ($eventMock, $subscriptionMock) {
                if ($class === Subscription::class) {
                    return $subscriptionMock;
                }

                return $eventMock;
            });

        $requestMock = $this->createMock(RequestInterface::class);
        $requestMock
            ->expects(self::atLeastOnce())
            ->method('getBody')
            ->willReturn($body);

        $requestMock
            ->expects(self::exactly(4))
            ->method('getHeader')
            ->willReturnCallback(function ($headerName) {
                switch ($headerName) {
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_SIGNATURE_HEADER:
                        return ['sha256=a6b2781c1ba6c9e5163fb9b6d12b65f8f31a5a12a4a078117523236cb9afb8f0'];
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_ID:
                        return ['guODBNx8dVAkMKTuV2jw4jcczoOYfLR1jplBd3VZwvg'];
                    case EventSubService::WEBHOOK_CALLBACK_MESSAGE_TIMESTAMP:
                        return ['2021-04-25T10:46:54.241081668Z'];
                    case EventSubService::WEBHOOK_CALLBACK_EVENT_TYPE:
                        return ['stream.offline'];
                }

                throw new \RuntimeException('Unexpected header required');
            });

        $sut = new EventSubService($httpClientMock, $requestFactoryMock, $streamFactoryMock, $serializerMock, $twitchMock, []);
        $event = $sut->handleSubscriptionCallback($requestMock, $secret);

        $subscriptionCallbackResult = new EventResponse($subscriptionMock, $eventMock);

        self::assertEquals($subscriptionCallbackResult, $event);
    }
}
