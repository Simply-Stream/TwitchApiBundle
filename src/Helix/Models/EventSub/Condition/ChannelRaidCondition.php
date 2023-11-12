<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class ChannelRaidCondition implements ConditionInterface
{
    use SerializesModels;

    public function __construct(
        private ?string $fromBroadcasterUserId = null,
        private ?string $toBroadcasterUserId = null
    ) {
    }

    public function getFromBroadcasterUserId(): string {
        return $this->fromBroadcasterUserId;
    }

    public function getToBroadcasterUserId(): string {
        return $this->toBroadcasterUserId;
    }
}
