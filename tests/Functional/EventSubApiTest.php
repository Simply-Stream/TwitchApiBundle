<?php

namespace SimplyStream\TwitchApiBundle\Tests\Functional;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\StreamOnlineCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\CreateEventSubSubscriptionRequest;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\EventSubResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EventSubApiTest extends KernelTestCase
{
    public function testCreateEventSubSubscribtion() {
        $container = self::getContainer();
        $createEventSubSubscriptionRequest = new CreateEventSubSubscriptionRequest(
            'stream.online',
            1,
            new StreamOnlineCondition('75046945'),
            new Transport('webhook', 'https://localhost/twitch/eventsub', '1234567890')
        );

        $eventSubApi = $container->get('simplystream.twitch_api.helix_api.event_sub');
        $createEventSubSubscriptionResponse = $eventSubApi->createEventSubSubscription($createEventSubSubscriptionRequest);

        $this->assertInstanceOf(EventSubResponse::class, $createEventSubSubscriptionResponse);
    }

    protected function setUp(): void {
        self::bootKernel();
        parent::setUp();
    }
}
