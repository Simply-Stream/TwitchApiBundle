<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelAdBreakBeginCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelGuestStarGuestUpdateCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * (BETA) A guest or a slot is updated in an active Guest Star session.
 */
final readonly class ChannelGuestStarGuestUpdateSubscription extends Subscription
{
    public const TYPE = 'channel.guest_star_guest.update';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "beta"
    ) {
        parent::__construct($type, $version, new ChannelGuestStarGuestUpdateCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
