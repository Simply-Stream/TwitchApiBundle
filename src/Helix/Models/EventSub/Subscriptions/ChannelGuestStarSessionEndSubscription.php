<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelAdBreakBeginCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelGuestStarSessionEndCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * (BETA) A running Guest Star session has ended.
 */
final readonly class ChannelGuestStarSessionEndSubscription extends Subscription
{
    public const TYPE = 'channel.guest_star_session.end';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "beta"
    ) {
        parent::__construct($type, $version, new ChannelGuestStarSessionEndCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
