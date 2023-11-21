<?php

namespace SimplyStream\TwitchApiBundle\Tests\Functional;

use League\OAuth2\Client\Token\AccessToken;
use SimplyStream\TwitchApi\Helix\Models\EventSub\Condition;
use SimplyStream\TwitchApi\Helix\Models\EventSub\EventSubResponse;
use SimplyStream\TwitchApi\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApi\Helix\Models\EventSub\Subscriptions;
use SimplyStream\TwitchApi\Helix\Models\EventSub\Transport;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class EventSubApiTest extends KernelTestCase
{
    /**
     * @param Subscription $subscription
     * @param array        $expectation
     * @param string       $response
     *
     * @return void
     * @throws \Exception
     * @dataProvider createEventSubSubscribtionDataProvider
     */
    public function testCreateEventSubSubscribtion(Subscription $subscription, array $expectation, string $response) {
        $container = self::getContainer();
        $container->get(MockHttpClient::class)->setResponseFactory([new MockResponse($response)]);

        $accessToken = new AccessToken(['access_token' => '123456', 'token_type' => 'Bearer']);
        $eventSubApi = $container->get('simplystream.twitch_api.helix_api.event_sub');
        $createEventSubSubscriptionResponse = $eventSubApi->createEventSubSubscription($subscription, $accessToken);

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
            'Create ChannelAdBreakBeginSubscription' => [
                'subscription' => new Subscriptions\ChannelAdBreakBeginSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelAdBreakBeginSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.ad_break.begin',
                    'condition' => Condition\ChannelAdBreakBeginCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"5d199911-d650-4482-96cb-8c8edfab377e","status":"webhook_callback_verification_pending","type":"channel.ad_break.begin","version":"beta","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-11T19:26:28.916086425Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelBanSubscription' => [
                'subscription' => new Subscriptions\ChannelBanSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelBanSubscription::class,
                    'version' => '1',
                    'type' => 'channel.ban',
                    'condition' => Condition\ChannelBanCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"d030c03f-9a0e-4d25-adb7-b9b2d880f67c","status":"webhook_callback_verification_pending","type":"channel.ban","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-11T20:18:13.75317268Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChatClearSubscription' => [
                'subscription' => new Subscriptions\ChannelChatClearSubscription(['broadcasterUserId' => '12345678', 'userId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelChatClearSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.chat.clear',
                    'condition' => Condition\ChannelChatClearCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"2902a520-10a3-4e22-95b7-bbab7bf02b48","status":"webhook_callback_verification_pending","type":"channel.chat.clear","version":"beta","condition":{"broadcaster_user_id":"12345678","user_id":"12345678"},"created_at":"2023-11-11T20:33:36.428842282Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelChatClearUserMessagesSubscription' => [
                'subscription' => new Subscriptions\ChannelChatClearUserMessagesSubscription(['broadcasterUserId' => '12345678', 'userId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelChatClearUserMessagesSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.chat.clear_user_messages',
                    'condition' => Condition\ChannelChatClearUserMessagesCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"c5fe60d5-5a81-4a89-b09d-ed626e020782","status":"webhook_callback_verification_pending","type":"channel.chat.clear_user_messages","version":"beta","condition":{"broadcaster_user_id":"12345678","user_id":"12345678"},"created_at":"2023-11-11T20:46:00.755577502Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelChatMessageDeleteSubscription' => [
                'subscription' => new Subscriptions\ChannelChatMessageDeleteSubscription(['broadcasterUserId' => '12345678', 'userId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelChatMessageDeleteSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.chat.message_delete',
                    'condition' => Condition\ChannelChatMessageDeleteCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"579a9fe5-a4bd-4548-8d2b-41e5c976aee2","status":"webhook_callback_verification_pending","type":"channel.chat.message_delete","version":"beta","condition":{"broadcaster_user_id":"12345678","user_id":"12345678"},"created_at":"2023-11-11T20:48:06.743284791Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelChatNotificationSubscription' => [
                'subscription' => new Subscriptions\ChannelChatNotificationSubscription(['broadcasterUserId' => '12345678', 'userId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelChatNotificationSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.chat.notification',
                    'condition' => Condition\ChannelChatNotificationCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"33d1fb6b-c828-4540-9475-9cf2fd3cb7e4","status":"webhook_callback_verification_pending","type":"channel.chat.notification","version":"beta","condition":{"broadcaster_user_id":"12345678","user_id":"12345678"},"created_at":"2023-11-11T20:49:41.505724703Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelCheerSubscription' => [
                'subscription' => new Subscriptions\ChannelCheerSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelCheerSubscription::class,
                    'version' => '1',
                    'type' => 'channel.cheer',
                    'condition' => Condition\ChannelCheerCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"19e2c25e-4f9a-4561-bf3b-fd40e9021fae","status":"webhook_callback_verification_pending","type":"channel.cheer","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-11T20:51:45.239035007Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelFollowSubscription' => [
                'subscription' => new Subscriptions\ChannelFollowSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelFollowSubscription::class,
                    'version' => '2',
                    'type' => 'channel.follow',
                    'condition' => Condition\ChannelFollowCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"65bd3867-e6c8-417e-b587-b3b6e070f737","status":"webhook_callback_verification_pending","type":"channel.follow","version":"2","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-11T20:54:20.70042634Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelGuestStarGuestUpdateSubscription' => [
                'subscription' => new Subscriptions\ChannelGuestStarGuestUpdateSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelGuestStarGuestUpdateSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.guest_star_guest.update',
                    'condition' => Condition\ChannelGuestStarGuestUpdateCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"a176f467-34de-4ad6-8104-44f51883cb39","status":"webhook_callback_verification_pending","type":"channel.guest_star_guest.update","version":"beta","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-11T20:57:06.847149622Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelGuestStarSessionBeginSubscription' => [
                'subscription' => new Subscriptions\ChannelGuestStarSessionBeginSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelGuestStarSessionBeginSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.guest_star_session.begin',
                    'condition' => Condition\ChannelGuestStarSessionBeginCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"6dddeddd-0bb1-4cfb-9f2a-dda38cc973e8","status":"webhook_callback_verification_pending","type":"channel.guest_star_session.begin","version":"beta","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-11T20:58:25.775627349Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelGuestStarSessionEndSubscription' => [
                'subscription' => new Subscriptions\ChannelGuestStarSessionEndSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelGuestStarSessionEndSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.guest_star_session.end',
                    'condition' => Condition\ChannelGuestStarSessionEndCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"e72378b8-d4b1-4c44-b71c-88fd2fcb1759","status":"webhook_callback_verification_pending","type":"channel.guest_star_session.end","version":"beta","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-11T20:59:27.412179683Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelGuestStarSettingsUpdateSubscription' => [
                'subscription' => new Subscriptions\ChannelGuestStarSettingsUpdateSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelGuestStarSettingsUpdateSubscription::class,
                    'version' => 'beta',
                    'type' => 'channel.guest_star_settings.update',
                    'condition' => Condition\ChannelGuestStarSettingsUpdateCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"4bdd312b-39b5-4e56-8513-0748127d27cc","status":"webhook_callback_verification_pending","type":"channel.guest_star_settings.update","version":"beta","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-11T21:00:35.076450264Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelModeratorAddSubscription' => [
                'subscription' => new Subscriptions\ChannelModeratorAddSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelModeratorAddSubscription::class,
                    'version' => '1',
                    'type' => 'channel.moderator.add',
                    'condition' => Condition\ChannelModeratorAddCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"a12dd460-e242-44ca-bfcd-64436527f6c2","status":"webhook_callback_verification_pending","type":"channel.moderator.add","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-11T21:02:45.944896508Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelModeratorRemoveSubscription' => [
                'subscription' => new Subscriptions\ChannelModeratorRemoveSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelModeratorRemoveSubscription::class,
                    'version' => '1',
                    'type' => 'channel.moderator.remove',
                    'condition' => Condition\ChannelModeratorRemoveCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"aeed1c94-8004-4971-8358-cb729004ee20","status":"webhook_callback_verification_pending","type":"channel.moderator.remove","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-11T21:38:34.89445077Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPointsCustomRewardAddSubscription' => [
                'subscription' => new Subscriptions\ChannelPointsCustomRewardAddSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPointsCustomRewardAddSubscription::class,
                    'version' => '1',
                    'type' => 'channel.channel_points_custom_reward.add',
                    'condition' => Condition\ChannelPointsCustomRewardAddCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"193079ba-45b7-4632-a90c-7c351408a5cf","status":"webhook_callback_verification_pending","type":"channel.channel_points_custom_reward.add","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-11T21:39:45.977875458Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPointsCustomRewardRedemptionAddSubscription' => [
                'subscription' => new Subscriptions\ChannelPointsCustomRewardRedemptionAddSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPointsCustomRewardRedemptionAddSubscription::class,
                    'version' => '1',
                    'type' => 'channel.channel_points_custom_reward_redemption.add',
                    'condition' => Condition\ChannelPointsCustomRewardRedemptionAddCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"d5da61f5-61f1-4a8c-8159-f2bb21b2a59f","status":"webhook_callback_verification_pending","type":"channel.channel_points_custom_reward_redemption.add","version":"1","condition":{"broadcaster_user_id":"12345678","reward_id":""},"created_at":"2023-11-12T02:15:05.429924818Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPointsCustomRewardRedemptionUpdateSubscription' => [
                'subscription' => new Subscriptions\ChannelPointsCustomRewardRedemptionUpdateSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPointsCustomRewardRedemptionUpdateSubscription::class,
                    'version' => '1',
                    'type' => 'channel.channel_points_custom_reward_redemption.update',
                    'condition' => Condition\ChannelPointsCustomRewardRedemptionUpdateCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"8baece78-6d82-413b-a08d-ea9250b798b3","status":"webhook_callback_verification_pending","type":"channel.channel_points_custom_reward_redemption.update","version":"1","condition":{"broadcaster_user_id":"12345678","reward_id":""},"created_at":"2023-11-11T21:58:55.553280327Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPointsCustomRewardRemoveSubscription' => [
                'subscription' => new Subscriptions\ChannelPointsCustomRewardRemoveSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPointsCustomRewardRemoveSubscription::class,
                    'version' => '1',
                    'type' => 'channel.channel_points_custom_reward.remove',
                    'condition' => Condition\ChannelPointsCustomRewardRemoveCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"288ae985-b28c-404a-b048-1d4ec9ab6b09","status":"webhook_callback_verification_pending","type":"channel.channel_points_custom_reward.remove","version":"1","condition":{"broadcaster_user_id":"12345678","reward_id":""},"created_at":"2023-11-12T01:18:49.726097656Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPointsCustomRewardUpdateSubscription' => [
                'subscription' => new Subscriptions\ChannelPointsCustomRewardUpdateSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPointsCustomRewardUpdateSubscription::class,
                    'version' => '1',
                    'type' => 'channel.channel_points_custom_reward.update',
                    'condition' => Condition\ChannelPointsCustomRewardUpdateCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"8298a50f-d014-47b4-bf44-bb332f190d06","status":"webhook_callback_verification_pending","type":"channel.channel_points_custom_reward.update","version":"1","condition":{"broadcaster_user_id":"12345678","reward_id":""},"created_at":"2023-11-12T01:20:22.307600847Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPollBeginSubscription' => [
                'subscription' => new Subscriptions\ChannelPollBeginSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPollBeginSubscription::class,
                    'version' => '1',
                    'type' => 'channel.poll.begin',
                    'condition' => Condition\ChannelPollBeginCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"8bbead88-ef6c-4999-967b-5e4bbcd78cb3","status":"webhook_callback_verification_pending","type":"channel.poll.begin","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:23:13.604883691Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPollProgressSubscription' => [
                'subscription' => new Subscriptions\ChannelPollProgressSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPollProgressSubscription::class,
                    'version' => '1',
                    'type' => 'channel.poll.progress',
                    'condition' => Condition\ChannelPollProgressCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"8965afe0-9d37-4452-98d5-b8740aed85b5","status":"webhook_callback_verification_pending","type":"channel.poll.progress","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:24:48.034605536Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPollEndSubscription' => [
                'subscription' => new Subscriptions\ChannelPollEndSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPollEndSubscription::class,
                    'version' => '1',
                    'type' => 'channel.poll.end',
                    'condition' => Condition\ChannelPollEndCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"9c462c08-f1d6-43fc-8a6e-f66e12dfe252","status":"webhook_callback_verification_pending","type":"channel.poll.end","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:24:50.375040864Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPredictionBeginSubscription' => [
                'subscription' => new Subscriptions\ChannelPredictionBeginSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPredictionBeginSubscription::class,
                    'version' => '1',
                    'type' => 'channel.prediction.begin',
                    'condition' => Condition\ChannelPredictionBeginCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"d2a6fca7-634a-418f-aaaa-1eb11b98520f","status":"webhook_callback_verification_pending","type":"channel.prediction.begin","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:28:08.526156861Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPredictionProgressSubscription' => [
                'subscription' => new Subscriptions\ChannelPredictionProgressSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPredictionProgressSubscription::class,
                    'version' => '1',
                    'type' => 'channel.prediction.progress',
                    'condition' => Condition\ChannelPredictionProgressCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"8e5596f3-9950-41f1-b253-e725293192ae","status":"webhook_callback_verification_pending","type":"channel.prediction.progress","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:28:10.837663701Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPredictionLockSubscription' => [
                'subscription' => new Subscriptions\ChannelPredictionLockSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPredictionLockSubscription::class,
                    'version' => '1',
                    'type' => 'channel.prediction.lock',
                    'condition' => Condition\ChannelPredictionLockCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"222d49f8-6e85-4b7a-905a-efb9250064cb","status":"webhook_callback_verification_pending","type":"channel.prediction.lock","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:28:13.125824849Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelPredictionEndSubscription' => [
                'subscription' => new Subscriptions\ChannelPredictionEndSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelPredictionEndSubscription::class,
                    'version' => '1',
                    'type' => 'channel.prediction.end',
                    'condition' => Condition\ChannelPredictionEndCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"3784aa31-37bb-44b9-8c9a-f781b160428c","status":"webhook_callback_verification_pending","type":"channel.prediction.end","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:28:15.526543203Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelRaidSubscription' => [
                'subscription' => new Subscriptions\ChannelRaidSubscription(['toBroadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelRaidSubscription::class,
                    'version' => '1',
                    'type' => 'channel.raid',
                    'condition' => Condition\ChannelRaidCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"8411ff90-0112-4d42-babe-76a87cb4949f","status":"webhook_callback_verification_pending","type":"channel.raid","version":"1","condition":{"from_broadcaster_user_id":"","to_broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:36:32.046254335Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelSubscribeSubscription' => [
                'subscription' => new Subscriptions\ChannelSubscribeSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelSubscribeSubscription::class,
                    'version' => '1',
                    'type' => 'channel.subscribe',
                    'condition' => Condition\ChannelSubscribeCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"f02c49f7-54bd-49bd-8c28-bd10e7163406","status":"webhook_callback_verification_pending","type":"channel.subscribe","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:39:42.453552659Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelSubscriptionEndSubscription' => [
                'subscription' => new Subscriptions\ChannelSubscriptionEndSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelSubscriptionEndSubscription::class,
                    'version' => '1',
                    'type' => 'channel.subscription.end',
                    'condition' => Condition\ChannelSubscriptionEndCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"caba0fcd-5b71-4e4d-b891-f725cdc42661","status":"webhook_callback_verification_pending","type":"channel.subscription.end","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:40:40.333688573Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelSubscriptionGiftSubscription' => [
                'subscription' => new Subscriptions\ChannelSubscriptionGiftSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelSubscriptionGiftSubscription::class,
                    'version' => '1',
                    'type' => 'channel.subscription.gift',
                    'condition' => Condition\ChannelSubscriptionGiftCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"c6589dc5-0af1-485a-9a27-552fd4883740","status":"webhook_callback_verification_pending","type":"channel.subscription.gift","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:41:38.046865398Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelSubscriptionMessageSubscription' => [
                'subscription' => new Subscriptions\ChannelSubscriptionMessageSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelSubscriptionMessageSubscription::class,
                    'version' => '1',
                    'type' => 'channel.subscription.message',
                    'condition' => Condition\ChannelSubscriptionMessageCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"0c4f8a17-a9d8-4fbf-a7a9-0171edd9bf11","status":"webhook_callback_verification_pending","type":"channel.subscription.message","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:42:41.367356107Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelUnbanSubscription' => [
                'subscription' => new Subscriptions\ChannelUnbanSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelUnbanSubscription::class,
                    'version' => '1',
                    'type' => 'channel.unban',
                    'condition' => Condition\ChannelUnbanCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"dd497a02-606b-4fa4-b430-a251edbaa543","status":"webhook_callback_verification_pending","type":"channel.unban","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:43:39.145322449Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ChannelUpdateSubscription' => [
                'subscription' => new Subscriptions\ChannelUpdateSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ChannelUpdateSubscription::class,
                    'version' => '2',
                    'type' => 'channel.update',
                    'condition' => Condition\ChannelUpdateCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"533d8cd5-f2e1-4c06-8c15-a59874984bb3","status":"webhook_callback_verification_pending","type":"channel.update","version":"2","condition":{"broadcaster_user_id":"123456"},"created_at":"2023-11-09T11:29:25.779088685Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
//            I can't actually test this with real data due to missing mock endpoints from Twitch. We will assume, that they'd work fine .
//            'Create DropEntitlementGrantSubscription' => [
//                'subscription' => new Subscriptions\DropEntitlementGrantSubscription([], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
//                'expectation' => [
//                    'subscription' => Subscriptions\DropEntitlementGrantSubscription::class,
//                    'version' => '1',
//                    'type' => 'drop.entitlement.grant',
//                    'condition' => Condition\DropEntitlementGrantCondition::class,
//                ],
//                'response' => <<<'JSON'
//JSON
//            ],
//            I can't actually test this with real data due to missing mock endpoints from Twitch. We will assume, that they'd work fine .
//            'Create ExtensionBitsTransactionCreateSubscription' => [
//                'subscription' => new Subscriptions\ExtensionBitsTransactionCreateSubscription([], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
//                'expectation' => [
//                    'subscription' => Subscriptions\ExtensionBitsTransactionCreateSubscription::class,
//                    'version' => '1',
//                    'type' => 'extension.bits_transaction.create',
//                    'condition' => Condition\ExtensionBitsTransactionCreateCondition::class,
//                ],
//                'response' => <<<'JSON'
//JSON
//            ],
            'Create GoalsBeginSubscription' => [
                'subscription' => new Subscriptions\GoalsBeginSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\GoalsBeginSubscription::class,
                    'version' => '1',
                    'type' => 'channel.goal.begin',
                    'condition' => Condition\GoalsBeginCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"ad1bee95-cdd7-49b1-b0ab-6daf183a8b2c","status":"webhook_callback_verification_pending","type":"channel.goal.begin","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:48:14.109576551Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create GoalsProgressSubscription' => [
                'subscription' => new Subscriptions\GoalsProgressSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\GoalsProgressSubscription::class,
                    'version' => '1',
                    'type' => 'channel.goal.progress',
                    'condition' => Condition\GoalsProgressCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"9eb07ed1-2eb9-4652-83bd-d13116a345f6","status":"webhook_callback_verification_pending","type":"channel.goal.progress","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:49:52.054017327Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create GoalsEndSubscription' => [
                'subscription' => new Subscriptions\GoalsEndSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\GoalsEndSubscription::class,
                    'version' => '1',
                    'type' => 'channel.goal.end',
                    'condition' => Condition\GoalsEndCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"038f2479-89d1-40b5-aca5-ac098f2e4a67","status":"webhook_callback_verification_pending","type":"channel.goal.end","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:49:54.440611754Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create HypeTrainBeginSubscription' => [
                'subscription' => new Subscriptions\HypeTrainBeginSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\HypeTrainBeginSubscription::class,
                    'version' => '1',
                    'type' => 'channel.hype_train.begin',
                    'condition' => Condition\HypeTrainBeginCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"17daf275-4f58-45c1-b6ca-3ce79a5344a1","status":"webhook_callback_verification_pending","type":"channel.hype_train.begin","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:52:06.449602088Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create HypeTrainProgressSubscription' => [
                'subscription' => new Subscriptions\HypeTrainProgressSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\HypeTrainProgressSubscription::class,
                    'version' => '1',
                    'type' => 'channel.hype_train.progress',
                    'condition' => Condition\HypeTrainProgressCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"76d8ac8e-ea14-468b-bf81-19f7c8f47918","status":"webhook_callback_verification_pending","type":"channel.hype_train.progress","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:52:08.830458517Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ShieldModeBeginSubscription' => [
                'subscription' => new Subscriptions\ShieldModeBeginSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ShieldModeBeginSubscription::class,
                    'version' => '1',
                    'type' => 'channel.shield_mode.begin',
                    'condition' => Condition\ShieldModeBeginCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"f03cccd5-317b-4241-9f76-66e0116f10f1","status":"webhook_callback_verification_pending","type":"channel.shield_mode.begin","version":"1","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-12T01:55:06.554977207Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ShieldModeEndSubscription' => [
                'subscription' => new Subscriptions\ShieldModeEndSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ShieldModeEndSubscription::class,
                    'version' => '1',
                    'type' => 'channel.shield_mode.end',
                    'condition' => Condition\ShieldModeEndCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"5f83b38c-e556-42cf-bfae-cf9dbdeef89a","status":"webhook_callback_verification_pending","type":"channel.shield_mode.end","version":"1","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-12T01:55:08.831749922Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ShoutoutCreateSubscription' => [
                'subscription' => new Subscriptions\ShoutoutCreateSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ShoutoutCreateSubscription::class,
                    'version' => '1',
                    'type' => 'channel.shoutout.create',
                    'condition' => Condition\ShoutoutCreateCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"633d4bd1-03f4-4edf-be6c-f892138a7310","status":"webhook_callback_verification_pending","type":"channel.shoutout.create","version":"1","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-12T01:57:10.303558706Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create ShoutoutReceivedSubscription' => [
                'subscription' => new Subscriptions\ShoutoutReceivedSubscription(['broadcasterUserId' => '12345678', 'moderatorUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\ShoutoutReceivedSubscription::class,
                    'version' => '1',
                    'type' => 'channel.shoutout.receive',
                    'condition' => Condition\ShoutoutReceivedCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"c5ce08a8-9030-4898-bc2f-67b37f685897","status":"webhook_callback_verification_pending","type":"channel.shoutout.receive","version":"1","condition":{"broadcaster_user_id":"12345678","moderator_user_id":"12345678"},"created_at":"2023-11-12T01:57:56.587204034Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create StreamOfflineSubscription' => [
                'subscription' => new Subscriptions\StreamOfflineSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\StreamOfflineSubscription::class,
                    'version' => '1',
                    'type' => 'stream.offline',
                    'condition' => Condition\StreamOfflineCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"489ab1c3-db23-4058-bc2b-cf574e9833b9","status":"webhook_callback_verification_pending","type":"stream.offline","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:59:24.803573655Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create StreamOnlineSubscription' => [
                'subscription' => new Subscriptions\StreamOnlineSubscription(['broadcasterUserId' => '12345678'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\StreamOnlineSubscription::class,
                    'version' => '1',
                    'type' => 'stream.online',
                    'condition' => Condition\StreamOnlineCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"43c4162d-43b9-4f07-bc4d-48e75ee794f6","status":"webhook_callback_verification_pending","type":"stream.online","version":"1","condition":{"broadcaster_user_id":"12345678"},"created_at":"2023-11-12T01:59:27.198759166Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":0}],"total":1,"max_total_cost":10000,"total_cost":0}
JSON
            ],
            'Create UserAuthorizationGrantSubscription' => [
                'subscription' => new Subscriptions\UserAuthorizationGrantSubscription(['clientId' => 'asdf1234asdf1234asdf1234asdf123'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\UserAuthorizationGrantSubscription::class,
                    'version' => '1',
                    'type' => 'user.authorization.grant',
                    'condition' => Condition\UserAuthorizationGrantCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"47b7e123-8235-404c-89a0-017ffc4718ad","status":"webhook_callback_verification_pending","type":"user.authorization.grant","version":"1","condition":{"client_id":"asdf1234asdf1234asdf1234asdf123"},"created_at":"2023-11-12T02:01:38.953689024Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":1}],"total":1,"max_total_cost":10000,"total_cost":1}
JSON
            ],
            'Create UserAuthorizationRevokeSubscription' => [
                'subscription' => new Subscriptions\UserAuthorizationRevokeSubscription(['clientId' => 'asdf1234asdf1234asdf1234asdf123'], new Transport('webhook', 'https://localhost/check/twitch', '1234567890')),
                'expectation' => [
                    'subscription' => Subscriptions\UserAuthorizationRevokeSubscription::class,
                    'version' => '1',
                    'type' => 'user.authorization.revoke',
                    'condition' => Condition\UserAuthorizationRevokeCondition::class,
                ],
                'response' => <<<'JSON'
{"data":[{"id":"9cd9086f-6f6f-4841-a3e4-023b61309e24","status":"webhook_callback_verification_pending","type":"user.authorization.revoke","version":"1","condition":{"client_id":"asdf1234asdf1234asdf1234asdf123"},"created_at":"2023-11-12T02:02:31.671483975Z","transport":{"method":"webhook","callback":"https://localhost/check/twitch"},"cost":1}],"total":1,"max_total_cost":10000,"total_cost":1}
JSON
            ],
        ];
    }

    protected function setUp(): void {
        self::bootKernel();
        parent::setUp();
    }
}
