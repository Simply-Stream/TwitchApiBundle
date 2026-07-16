<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Nyholm\Psr7\Factory\Psr17Factory;
use SimplyStream\TwitchApi\EventSub\Dedup\InMemoryProcessedMessageStore;
use SimplyStream\TwitchApi\EventSub\EventSubMessageProcessor;
use SimplyStream\TwitchApi\EventSub\Registry\EventSubTypeRegistry;
use SimplyStream\TwitchApi\EventSub\Registry\EventSubTypeRegistryBuilder;
use SimplyStream\TwitchApi\EventSub\Security\MessageFreshnessValidator;
use SimplyStream\TwitchApi\EventSub\Security\MessageSignatureVerifier;
use SimplyStream\TwitchApi\Helix\Api\AdsApi;
use SimplyStream\TwitchApi\Helix\Api\AnalyticsApi;
use SimplyStream\TwitchApi\Helix\Api\ApiClient;
use SimplyStream\TwitchApi\Helix\Api\ApiClientInterface;
use SimplyStream\TwitchApi\Helix\Api\BitsApi;
use SimplyStream\TwitchApi\Helix\Api\ChannelPointsApi;
use SimplyStream\TwitchApi\Helix\Api\ChannelsApi;
use SimplyStream\TwitchApi\Helix\Api\CharityApi;
use SimplyStream\TwitchApi\Helix\Api\ChatApi;
use SimplyStream\TwitchApi\Helix\Api\ClipsApi;
use SimplyStream\TwitchApi\Helix\Api\ContentClassificationApi;
use SimplyStream\TwitchApi\Helix\Api\EntitlementsApi;
use SimplyStream\TwitchApi\Helix\Api\EventSubApi;
use SimplyStream\TwitchApi\Helix\Api\ExtensionsApi;
use SimplyStream\TwitchApi\Helix\Api\GamesApi;
use SimplyStream\TwitchApi\Helix\Api\GoalsApi;
use SimplyStream\TwitchApi\Helix\Api\GuestStarApi;
use SimplyStream\TwitchApi\Helix\Api\HypeTrainApi;
use SimplyStream\TwitchApi\Helix\Api\ModerationApi;
use SimplyStream\TwitchApi\Helix\Api\PollsApi;
use SimplyStream\TwitchApi\Helix\Api\PredictionsApi;
use SimplyStream\TwitchApi\Helix\Api\RaidsApi;
use SimplyStream\TwitchApi\Helix\Api\ScheduleApi;
use SimplyStream\TwitchApi\Helix\Api\SearchApi;
use SimplyStream\TwitchApi\Helix\Api\StreamsApi;
use SimplyStream\TwitchApi\Helix\Api\SubscriptionsApi;
use SimplyStream\TwitchApi\Helix\Api\TeamsApi;
use SimplyStream\TwitchApi\Helix\Api\TwitchApi;
use SimplyStream\TwitchApi\Helix\Api\UsersApi;
use SimplyStream\TwitchApi\Helix\Api\VideosApi;
use SimplyStream\TwitchApi\Helix\Api\WhispersApi;
use SimplyStream\TwitchApi\Serialization\DenormalizerInterface;
use SimplyStream\TwitchApi\Serialization\NormalizerInterface;
use SimplyStream\TwitchApi\SymfonySerializer\TwitchSerializerAdapter;
use SimplyStream\TwitchApi\SymfonySerializer\TwitchSerializerFactory;
use SimplyStream\TwitchApiBundle\Clock\SystemClock;
use Symfony\Component\HttpClient\Psr18Client;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    // --- Infrastructure -------------------------------------------------------------------

    $services->set('simplystream.twitch_api.psr18_client', Psr18Client::class);

    $services->set('simplystream.twitch_api.psr17_factory', Psr17Factory::class);

    $services->set('simplystream.twitch_api.serializer', TwitchSerializerAdapter::class)
        ->factory([TwitchSerializerFactory::class, 'create']);

    $services->alias(DenormalizerInterface::class, 'simplystream.twitch_api.serializer');
    $services->alias(NormalizerInterface::class, 'simplystream.twitch_api.serializer');

    $services->set('simplystream.twitch_api.api_client', ApiClient::class)
        ->args([
            service('simplystream.twitch_api.psr18_client'),
            service('simplystream.twitch_api.psr17_factory'),
            service('simplystream.twitch_api.psr17_factory'),
            abstract_arg('clientId, set by the bundle extension'),
        ])
        ->public();

    $services->alias(ApiClientInterface::class, 'simplystream.twitch_api.api_client');
    $services->alias(ApiClient::class, 'simplystream.twitch_api.api_client');

    // --- Helix API namespaces -------------------------------------------------------------

    $apis = [
        'ads'                    => AdsApi::class,
        'analytics'              => AnalyticsApi::class,
        'bits'                   => BitsApi::class,
        'channel_points'         => ChannelPointsApi::class,
        'channels'               => ChannelsApi::class,
        'charity'                => CharityApi::class,
        'chat'                   => ChatApi::class,
        'clips'                  => ClipsApi::class,
        'content_classification' => ContentClassificationApi::class,
        'entitlements'           => EntitlementsApi::class,
        'event_sub'              => EventSubApi::class,
        'extensions'             => ExtensionsApi::class,
        'games'                  => GamesApi::class,
        'goals'                  => GoalsApi::class,
        'guest_star'             => GuestStarApi::class,
        'hype_train'             => HypeTrainApi::class,
        'moderation'             => ModerationApi::class,
        'polls'                  => PollsApi::class,
        'predictions'            => PredictionsApi::class,
        'raids'                  => RaidsApi::class,
        'schedule'               => ScheduleApi::class,
        'search'                 => SearchApi::class,
        'streams'                => StreamsApi::class,
        'subscriptions'          => SubscriptionsApi::class,
        'teams'                  => TeamsApi::class,
        'users'                  => UsersApi::class,
        'videos'                 => VideosApi::class,
        'whispers'               => WhispersApi::class,
    ];

    foreach ($apis as $name => $class) {
        $id = 'simplystream.twitch_api.helix_api.' . $name;

        $services->set($id, $class)
            ->args([
                service('simplystream.twitch_api.api_client'),
                service('simplystream.twitch_api.serializer'),
                service('simplystream.twitch_api.serializer'),
            ])
            ->public();

        $services->alias($class, $id);
    }

    // --- EventSub webhook pipeline --------------------------------------------------------

    $services->set('simplystream.twitch_api.event_sub.clock', SystemClock::class);

    $services->set('simplystream.twitch_api.event_sub.signature_verifier', MessageSignatureVerifier::class)
        ->args([abstract_arg('webhook secret, set by the bundle extension')]);

    $services->set('simplystream.twitch_api.event_sub.freshness_validator', MessageFreshnessValidator::class)
        ->args(['$clock' => service('simplystream.twitch_api.event_sub.clock')]);

    $services->set('simplystream.twitch_api.event_sub.processed_message_store', InMemoryProcessedMessageStore::class);

    $services->set('simplystream.twitch_api.event_sub.registry_builder', EventSubTypeRegistryBuilder::class);

    $services->set('simplystream.twitch_api.event_sub.registry', EventSubTypeRegistry::class)
        ->factory([service('simplystream.twitch_api.event_sub.registry_builder'), 'build'])
        ->args([abstract_arg('event class list, set by the bundle extension')]);

    $services->set('simplystream.twitch_api.event_sub.message_processor', EventSubMessageProcessor::class)
        ->args([
            service('simplystream.twitch_api.event_sub.signature_verifier'),
            service('simplystream.twitch_api.event_sub.freshness_validator'),
            service('simplystream.twitch_api.event_sub.processed_message_store'),
            service('simplystream.twitch_api.event_sub.registry'),
            service('simplystream.twitch_api.serializer'),
        ])
        ->public();

    $services->alias(EventSubMessageProcessor::class, 'simplystream.twitch_api.event_sub.message_processor');

    // --- Aggregate ------------------------------------------------------------------------

    // ContentClassificationApi and GuestStarApi exist as standalone services but are not part of
    // the aggregate — TwitchApi's constructor doesn't take them.
    // TODO: Add as soon as they are in the constructor
    $services->set('simplystream.twitch_api.helix_api.twitch_api', TwitchApi::class)
        ->args([
            '$analyticsApi'      => service('simplystream.twitch_api.helix_api.analytics'),
            '$bitsApi'           => service('simplystream.twitch_api.helix_api.bits'),
            '$channelPointsApi'  => service('simplystream.twitch_api.helix_api.channel_points'),
            '$channelsApi'       => service('simplystream.twitch_api.helix_api.channels'),
            '$charityApi'        => service('simplystream.twitch_api.helix_api.charity'),
            '$chatApi'           => service('simplystream.twitch_api.helix_api.chat'),
            '$clipsApi'          => service('simplystream.twitch_api.helix_api.clips'),
            '$adsApi'            => service('simplystream.twitch_api.helix_api.ads'),
            '$entitlementsApi'   => service('simplystream.twitch_api.helix_api.entitlements'),
            '$eventSubApi'       => service('simplystream.twitch_api.helix_api.event_sub'),
            '$extensionsApi'     => service('simplystream.twitch_api.helix_api.extensions'),
            '$gamesApi'          => service('simplystream.twitch_api.helix_api.games'),
            '$goalsApi'          => service('simplystream.twitch_api.helix_api.goals'),
            '$hypeTrainApi'      => service('simplystream.twitch_api.helix_api.hype_train'),
            '$moderationApi'     => service('simplystream.twitch_api.helix_api.moderation'),
            '$pollsApi'          => service('simplystream.twitch_api.helix_api.polls'),
            '$predictionsApi'    => service('simplystream.twitch_api.helix_api.predictions'),
            '$raidsApi'          => service('simplystream.twitch_api.helix_api.raids'),
            '$scheduleApi'       => service('simplystream.twitch_api.helix_api.schedule'),
            '$searchApi'         => service('simplystream.twitch_api.helix_api.search'),
            '$streamsApi'        => service('simplystream.twitch_api.helix_api.streams'),
            '$subscriptionsApi'  => service('simplystream.twitch_api.helix_api.subscriptions'),
            '$teamsApi'          => service('simplystream.twitch_api.helix_api.teams'),
            '$usersApi'          => service('simplystream.twitch_api.helix_api.users'),
            '$videosApi'         => service('simplystream.twitch_api.helix_api.videos'),
            '$whispersApi'       => service('simplystream.twitch_api.helix_api.whispers'),
        ])
        ->public();

    $services->alias(TwitchApi::class, 'simplystream.twitch_api.helix_api.twitch_api');
};
