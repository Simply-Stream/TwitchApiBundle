<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelPointsCustomRewardRedemptionUpdateCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * A redemption of a channel points custom reward has been updated for the specified channel.
 */
final readonly class ChannelPointsCustomRewardRedemptionUpdateSubscription extends Subscription
{
    public const TYPE = 'channel.channel_points_custom_reward_redemption.update';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "1"
    ) {
        parent::__construct($type, $version, new ChannelPointsCustomRewardRedemptionUpdateCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
