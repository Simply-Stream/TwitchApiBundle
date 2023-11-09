<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelPointsCustomRewardRedemptionAddCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * A viewer has redeemed a custom channel points reward on the specified channel.
 */
final readonly class ChannelPointsCustomRewardRedemptionAddSubscription extends Subscription
{
    public const TYPE = 'channel.channel_points_custom_reward_redemption.add';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "1"
    ) {
        parent::__construct($type, $version, new ChannelPointsCustomRewardRedemptionAddCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
