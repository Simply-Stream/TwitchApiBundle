<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class ChannelPointsCustomRewardUpdateCondition implements ConditionInterface
{
    use SerializesModels;

    public function __construct(
        private string $broadcasterUserId,
        private ?string $rewardId = null
    ) {
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getRewardId(): ?string {
        return $this->rewardId;
    }
}