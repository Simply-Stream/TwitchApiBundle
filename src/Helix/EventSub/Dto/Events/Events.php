<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

interface Events
{
    public const AVAILABLE_EVENTS = [
        'channel.update' => ChannelUpdateEvent::class,
        'channel.follow' => ChannelFollowEvent::class,
        'channel.subscribe' => ChannelSubscribeEvent::class,
        'channel.subscription.end' => ChannelSubscriptionEndEvent::class,
        'channel.subscription.gift' => ChannelSubscriptionGiftEvent::class,
        'channel.subscription.message' => ChannelSubscriptionMessageEvent::class,
        'channel.cheer' => ChannelCheerEvent::class,
        'channel.raid' => ChannelRaidEvent::class,
        'channel.ban' => ChannelBanEvent::class,
        'channel.unban' => ChannelUnbanEvent::class,
        'channel.moderator.add' => ChannelModeratorAddEvent::class,
        'channel.moderator.remove' => ChannelModeratorRemoveEvent::class,
        'channel.channel_points_custom_reward.add' => ChannelPointsCustomRewardAddEvent::class,
        'channel.channel_points_custom_reward.update' => ChannelPointsCustomRewardUpdateEvent::class,
        'channel.channel_points_custom_reward.remove' => ChannelPointsCustomRewardRemoveEvent::class,
        'channel.channel_points_custom_reward_redemption.add' => ChannelPointsCustomRewardRedemptionAddEvent::class,
        'channel.channel_points_custom_reward_redemption.update' => ChannelPointsCustomRewardRedemptionUpdateEvent::class,
        'channel.poll.begin' => ChannelPollBeginEvent::class,
        'channel.poll.progress' => ChannelPollProgressEvent::class,
        'channel.poll.end' => ChannelPollEndEvent::class,
        'channel.prediction.begin' => ChannelPredictionLockEvent::class,
        'channel.prediction.progress' => ChannelPredictionProgressEvent::class,
        'channel.prediction.lock' => ChannelPredictionLockEvent::class,
        'channel.prediction.end' => ChannelPredictionEndEvent::class,
        'drop.entitlement.grant' => DropEntitlementGrantEvent::class,
        'extension.bits_transaction.create' => ExtensionBitsTransactionCreateEvent::class,
        'channel.goal.begin' => UserAuthorizationGrantEvent::class,
        'channel.goal.progress' => ChannelGoalProgressEvent::class,
        'channel.goal.end' => ChannelGoalEndEvent::class,
        'channel.hype_train.begin' => HypeTrainBeginEvent::class,
        'channel.hype_train.progress' => HypeTrainProgressEvent::class,
        'channel.hype_train.end' => HypeTrainEndEvent::class,
        'stream.online' => StreamOnlineEvent::class,
        'stream.offline' => StreamOfflineEvent::class,
        'user.authorization.grant' => UserAuthorizationGrantEvent::class,
        'user.authorization.revoke' => UserAuthorizationRevokeEvent::class,
        'user.update' => UserUpdateEvent::class,
    ];
}
