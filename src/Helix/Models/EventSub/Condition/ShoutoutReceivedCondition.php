<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class ShoutoutReceivedCondition implements ConditionInterface
{
    use SerializesModels;

    public function __construct(
        private string $broadcasterUserId,
        private string $moderatorUserId
    ) {
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getModeratorUserId(): string {
        return $this->moderatorUserId;
    }
}
