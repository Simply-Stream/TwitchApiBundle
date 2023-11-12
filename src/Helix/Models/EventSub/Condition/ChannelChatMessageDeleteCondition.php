<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

class ChannelChatMessageDeleteCondition implements ConditionInterface
{
    use SerializesModels;

    public function __construct(
        private string $broadcasterUserId,
        private string $userId
    ) {
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getUserId(): string {
        return $this->userId;
    }
}
