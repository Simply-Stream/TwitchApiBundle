<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelFollowCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * A specified channel receives a follow.
 */
final readonly class ChannelFollowSubscription extends Subscription
{
    public const TYPE = 'channel.follow';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "2"
    ) {
        parent::__construct($type, $version, new ChannelFollowCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
