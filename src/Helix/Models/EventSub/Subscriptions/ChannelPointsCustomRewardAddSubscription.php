<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelPointsCustomRewardAddCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * A custom channel points reward has been created for the specified channel.
 */
final readonly class ChannelPointsCustomRewardAddSubscription extends Subscription
{
    public const TYPE = 'channel.channel_points_custom_reward.add';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "1"
    ) {
        parent::__construct($type, $version, new ChannelPointsCustomRewardAddCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
