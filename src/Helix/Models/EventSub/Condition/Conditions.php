<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

interface Conditions
{
    public const MAP = [
        ChannelAdBreakBeginCondition::TYPE => ChannelAdBreakBeginCondition::class,
        ChannelBanCondition::TYPE => ChannelBanCondition::class,
        ChannelChatClearCondition::TYPE => ChannelChatClearCondition::class,
        ChannelChatClearUserMessagesCondition::TYPE => ChannelChatClearUserMessagesCondition::class,
        ChannelChatMessageDeleteCondition::TYPE => ChannelChatMessageDeleteCondition::class,
        ChannelChatNotificationCondition::TYPE => ChannelChatNotificationCondition::class,
        ChannelCheerCondition::TYPE => ChannelCheerCondition::class,
        ChannelFollowCondition::TYPE => ChannelFollowCondition::class,
        ChannelGuestStarGuestUpdateCondition::TYPE => ChannelGuestStarGuestUpdateCondition::class,
        ChannelGuestStarSessionBeginCondition::TYPE => ChannelGuestStarSessionBeginCondition::class,
        ChannelGuestStarSessionEndCondition::TYPE => ChannelGuestStarSessionEndCondition::class,
        ChannelGuestStarSettingsUpdateCondition::TYPE => ChannelGuestStarSettingsUpdateCondition::class,
        ChannelModeratorAddCondition::TYPE => ChannelModeratorAddCondition::class,
        ChannelModeratorRemoveCondition::TYPE => ChannelModeratorRemoveCondition::class,
        ChannelPointsCustomRewardAddCondition::TYPE => ChannelPointsCustomRewardAddCondition::class,
        ChannelPointsCustomRewardRedemptionAddCondition::TYPE => ChannelPointsCustomRewardRedemptionAddCondition::class,
        ChannelPointsCustomRewardRedemptionUpdateCondition::TYPE => ChannelPointsCustomRewardRedemptionUpdateCondition::class,
        ChannelPointsCustomRewardRemoveCondition::TYPE => ChannelPointsCustomRewardRemoveCondition::class,
        ChannelPointsCustomRewardUpdateCondition::TYPE => ChannelPointsCustomRewardUpdateCondition::class,
        ChannelPollBeginCondition::TYPE => ChannelPollBeginCondition::class,
        ChannelPollProgressCondition::TYPE => ChannelPollProgressCondition::class,
        ChannelPollEndCondition::TYPE => ChannelPollEndCondition::class,
        ChannelPredictionBeginCondition::TYPE => ChannelPredictionBeginCondition::class,
        ChannelPredictionProgressCondition::TYPE => ChannelPredictionProgressCondition::class,
        ChannelPredictionLockCondition::TYPE => ChannelPredictionLockCondition::class,
        ChannelPredictionEndCondition::TYPE => ChannelPredictionEndCondition::class,
        ChannelRaidCondition::TYPE => ChannelRaidCondition::class,
        ChannelSubscribeCondition::TYPE => ChannelSubscribeCondition::class,
        ChannelSubscriptionEndCondition::TYPE => ChannelSubscriptionEndCondition::class,
        ChannelSubscriptionGiftCondition::TYPE => ChannelSubscriptionGiftCondition::class,
        ChannelSubscriptionMessageCondition::TYPE => ChannelSubscriptionMessageCondition::class,
        ChannelUnbanCondition::TYPE => ChannelUnbanCondition::class,
        ChannelUpdateCondition::TYPE => ChannelUpdateCondition::class,
        DropEntitlementGrantCondition::TYPE => DropEntitlementGrantCondition::class,
        ExtensionBitsTransactionCreateCondition::TYPE => ExtensionBitsTransactionCreateCondition::class,
        GoalsBeginCondition::TYPE => GoalsBeginCondition::class,
        GoalsProgressCondition::TYPE => GoalsProgressCondition::class,
        GoalsEndCondition::TYPE => GoalsEndCondition::class,
        HypeTrainBeginCondition::TYPE => HypeTrainBeginCondition::class,
        HypeTrainProgressCondition::TYPE => HypeTrainProgressCondition::class,
        HypeTrainEndCondition::TYPE => HypeTrainEndCondition::class,
        ShieldModeBeginCondition::TYPE => ShieldModeBeginCondition::class,
        ShieldModeEndCondition::TYPE => ShieldModeEndCondition::class,
        ShoutoutCreateCondition::TYPE => ShoutoutCreateCondition::class,
        ShoutoutReceivedCondition::TYPE => ShoutoutReceivedCondition::class,
        StreamOfflineCondition::TYPE => StreamOfflineCondition::class,
        StreamOnlineCondition::TYPE => StreamOnlineCondition::class,
        UserAuthorizationGrantCondition::TYPE => UserAuthorizationGrantCondition::class,
        UserAuthorizationRevokeCondition::TYPE => UserAuthorizationRevokeCondition::class,
        UserUpdateCondition::TYPE => UserUpdateCondition::class
    ];
}
