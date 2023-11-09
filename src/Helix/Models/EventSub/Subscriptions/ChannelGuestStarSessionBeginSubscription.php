<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelAdBreakBeginCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelGuestStarSessionBeginCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * (BETA) The host began a new Guest Star session.
 */
final readonly class ChannelGuestStarSessionBeginSubscription extends Subscription
{
    public const TYPE = 'channel.guest_star_session.begin';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "beta"
    ) {
        parent::__construct($type, $version, new ChannelGuestStarSessionBeginCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
