<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ShoutoutCreateCondition;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Transport;

/**
 * Sends a notification when the specified broadcaster sends a Shoutout.
 */
final readonly class ShoutoutCreateSubscription extends Subscription
{
    public const TYPE = 'channel.shoutout.create';

    public function __construct(
        array $condition,
        Transport $transport,
        ?string $id = null,
        ?string $status = null,
        ?\DateTimeImmutable $createdAt = null,
        ?string $type = self::TYPE,
        ?string $version = "1"
    ) {
        parent::__construct($type, $version, new ShoutoutCreateCondition(...$condition), $transport, $id, $status, $createdAt);
    }
}
