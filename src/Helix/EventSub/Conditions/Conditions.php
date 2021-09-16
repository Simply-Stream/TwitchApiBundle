<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

interface Conditions
{
    public const CONDITIONS = [
        ChannelBanCondition::TYPE => ChannelBanCondition::class,
        ChannelCheerCondition::TYPE => ChannelCheerCondition::class,
        ChannelFollowCondition::TYPE => ChannelFollowCondition::class,
        ChannelPointsCustomRewardAddCondition::TYPE => ChannelPointsCustomRewardAddCondition::class,
        ChannelPointsCustomRewardUpdateCondition::TYPE => ChannelPointsCustomRewardUpdateCondition::class,
        ChannelPointsCustomRewardRemoveCondition::TYPE => ChannelPointsCustomRewardRemoveCondition::class,
        ChannelPointsCustomRewardRedemptionAddCondition::TYPE => ChannelPointsCustomRewardRedemptionAddCondition::class,
        ChannelPointsCustomRewardRedemptionUpdateCondition::TYPE => ChannelPointsCustomRewardRedemptionUpdateCondition::class,
        ChannelSubscribeCondition::TYPE => ChannelSubscribeCondition::class,
        ChannelUnbanCondition::TYPE => ChannelUnbanCondition::class,
        ChannelUpdateCondition::TYPE => ChannelUpdateCondition::class,
        HypeTrainBeginCondition::TYPE => HypeTrainBeginCondition::class,
        HypeTrainProgressCondition::TYPE => HypeTrainProgressCondition::class,
        HypeTrainEndCondition::TYPE => HypeTrainEndCondition::class,
        StreamOfflineCondition::TYPE => StreamOfflineCondition::class,
        StreamOnlineCondition::TYPE => StreamOnlineCondition::class,
        UserAuthorizationRevokeCondition::TYPE => UserAuthorizationRevokeCondition::class,
        UserUpdateCondition::TYPE => UserUpdateCondition::class,
    ];
}
