<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

interface Conditions
{
    public const CONDITIONS = [
        ChannelBanCondition::TYPE => ChannelBanCondition::class,
        ChannelSubscribeCondition::TYPE => ChannelSubscribeCondition::class,
        ChannelSubscriptionEndCondition::TYPE => ChannelSubscriptionEndCondition::class,
        ChannelSubscriptionGiftCondition::TYPE => ChannelSubscriptionGiftCondition::class,
        ChannelSubscriptionMessageCondition::TYPE => ChannelSubscriptionMessageCondition::class,
        ChannelCheerCondition::TYPE => ChannelCheerCondition::class,
        ChannelUpdateCondition::TYPE => ChannelUpdateCondition::class,
        ChannelFollowCondition::TYPE => ChannelFollowCondition::class,
        ChannelUnbanCondition::TYPE => ChannelUnbanCondition::class,
        ChannelRaidCondition::TYPE => ChannelRaidCondition::class,
        ChannelModeratorAddCondition::TYPE => ChannelModeratorAddCondition::class,
        ChannelModeratorRemoveCondition::TYPE => ChannelModeratorRemoveCondition::class,
        ChannelPointsCustomRewardAddCondition::TYPE => ChannelPointsCustomRewardAddCondition::class,
        ChannelPointsCustomRewardUpdateCondition::TYPE => ChannelPointsCustomRewardUpdateCondition::class,
        ChannelPointsCustomRewardRemoveCondition::TYPE => ChannelPointsCustomRewardRemoveCondition::class,
        ChannelPointsCustomRewardRedemptionAddCondition::TYPE => ChannelPointsCustomRewardRedemptionAddCondition::class,
        ChannelPointsCustomRewardRedemptionUpdateCondition::TYPE => ChannelPointsCustomRewardRedemptionUpdateCondition::class,
        ChannelPollBeginCondition::TYPE => ChannelPollBeginCondition::class,
        ChannelPollProgressCondition::TYPE => ChannelPollProgressCondition::class,
        ChannelPollEndCondition::TYPE => ChannelPollEndCondition::class,
        ChannelPredictionBeginCondition::TYPE => ChannelPredictionBeginCondition::class,
        ChannelPredictionProgressCondition::TYPE => ChannelPredictionProgressCondition::class,
        ChannelPredictionLockCondition::TYPE => ChannelPredictionLockCondition::class,
        ChannelPredictionEndCondition::TYPE => ChannelPredictionEndCondition::class,
        DropEntitlementGrantCondition::TYPE => DropEntitlementGrantCondition::class,
        ExtensionBitsTransactionCreateCondition::TYPE => ExtensionBitsTransactionCreateCondition::class,
        ChannelGoalBeginCondition::TYPE => ChannelGoalBeginCondition::class,
        ChannelGoalProgressCondition::TYPE => ChannelGoalProgressCondition::class,
        ChannelGoalEndCondition::TYPE => ChannelGoalEndCondition::class,
        HypeTrainBeginCondition::TYPE => HypeTrainBeginCondition::class,
        HypeTrainProgressCondition::TYPE => HypeTrainProgressCondition::class,
        HypeTrainEndCondition::TYPE => HypeTrainEndCondition::class,
        StreamOfflineCondition::TYPE => StreamOfflineCondition::class,
        StreamOnlineCondition::TYPE => StreamOnlineCondition::class,
        UserAuthorizationGrantCondition::TYPE => UserAuthorizationGrantCondition::class,
        UserAuthorizationRevokeCondition::TYPE => UserAuthorizationRevokeCondition::class,
        UserUpdateCondition::TYPE => UserUpdateCondition::class,
    ];
}
