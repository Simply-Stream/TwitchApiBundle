<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelAdBreakBeginCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelGuestStarSettingsUpdateCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * (BETA) The host preferences for Guest Star have been updated.
 */
final readonly class ChannelGuestStarSettingsUpdateSubscription extends Subscription
{
    public const TYPE = 'channel.guest_star_settings.update';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "beta"
    ) {
        parent::__construct($type, $version, new ChannelGuestStarSettingsUpdateCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
