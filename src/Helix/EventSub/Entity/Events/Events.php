<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

interface Events
{
    public const AVAILABLE_EVENTS = [
        'channel.update' => ChannelUpdateEvent::class,
        'channel.follow' => ChannelFollowEvent::class,
        'channel.subscribe' => ChannelSubscribeEvent::class,
        'channel.cheer' => ChannelCheerEvent::class,
        'channel.raid' => ChannelRaidEvent::class,
        'channel.ban' => ChannelBanEvent::class,
        'channel.unban' => ChannelUnbanEvent::class,
        'channel.channel_points_custom_reward.add' => ChannelPointsCustomRewardAddEvent::class,
        'channel.channel_points_custom_reward.update' => ChannelPointsCustomRewardUpdateEvent::class,
        'channel.channel_points_custom_reward.remove' => ChannelPointsCustomRewardRemoveEvent::class,
        'channel.channel_points_custom_reward_redemption.add' => ChannelPointsCustomRewardRedemptionAddEvent::class,
        'channel.channel_points_custom_reward_redemption.update' => ChannelPointsCustomRewardRedemptionUpdateEvent::class,
        'channel.hype_train.begin' => HypeTrainBeginEvent::class,
        'channel.hype_train.progress' => HypeTrainProgressEvent::class,
        'channel.hype_train.end' => HypeTrainEndEvent::class,
        'stream.online' => StreamOnlineEvent::class,
        'stream.offline' => StreamOfflineEvent::class,
        'user.authorization.revoke' => UserAuthorizationRevokeEvent::class,
        'user.update' => UserUpdateEvent::class,
    ];
}
