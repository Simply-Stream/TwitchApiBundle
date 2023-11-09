<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelChatNotificationCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ChannelFollowCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * (BETA) A notification for when an event that appears in chat has occurred.
 */
final readonly class ChannelChatNotificationSubscription extends Subscription
{
    public const TYPE = 'channel.chat.notification';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "beta"
    ) {
        parent::__construct($type, $version, new ChannelChatNotificationCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
