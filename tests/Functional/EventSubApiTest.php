<?php

namespace SimplyStream\TwitchApiBundle\Tests\Functional;

use League\OAuth2\Client\Token\AccessToken;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelUpdateCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\EventSubResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions\ChannelUpdateSubscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class EventSubApiTest extends KernelTestCase
{
    /**
     * @param Subscription $subscription
     * @param array        $expectation
     *
     * @return void
     * @throws \Exception
     * @dataProvider createEventSubSubscribtionDataProvider
     */
    public function testCreateEventSubSubscribtion(Subscription $subscription, array $expectation, string $response) {
        $container = self::getContainer();
        $container->get(MockHttpClient::class)->setResponseFactory([new MockResponse($response)]);

        $eventSubApi = $container->get('simplystream.twitch_api.helix_api.event_sub');
        $createEventSubSubscriptionResponse = $eventSubApi->createEventSubSubscription($subscription, new AccessToken(['access_token' => '123', 'token_type' => 'bearer']));

        $this->assertInstanceOf(EventSubResponse::class, $createEventSubSubscriptionResponse);
        $this->assertIsArray($createEventSubSubscriptionResponse->getData());

        foreach ($createEventSubSubscriptionResponse->getData() as $eventSub) {
            $this->assertInstanceOf($expectation['subscription'], $eventSub);
            $this->assertSame($expectation['version'], $eventSub->getVersion());
            $this->assertSame($expectation['type'], $eventSub->getType());
            $this->assertInstanceOf($expectation['condition'], $eventSub->getCondition());
        }
    }

    public function createEventSubSubscribtionDataProvider() {
        return [
            'Create Channel Update subscription' => [
                'subscription' => new ChannelUpdateSubscription(['broadcasterUserId' => '75046945'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => ChannelUpdateSubscription::class,
                    'version' => '2',
                    'type' => 'channel.update',
                    'condition' => ChannelUpdateCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"533d8cd5-f2e1-4c06-8c15-a59874984bb3","status":"webhook_callback_verification_pending","type":"channel.update","version":"2","condition":{"broadcaster_user_id":"123456"},"created_at":"2023-11-09T11:29:25.779088685Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ]
        ];
    }

    protected function setUp(): void {
        self::bootKernel();
        parent::setUp();
    }
}
