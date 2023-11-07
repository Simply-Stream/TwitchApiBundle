<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class ChannelChatClearCondition implements ConditionInterface
{
    public const TYPE = 'channel.chat.clear';

    public function __construct(
        private string $broadcasterUserId,
        private string $userId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getUserId(): string {
        return $this->userId;
    }
}
