<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class ChannelModeratorAddCondition implements ConditionInterface
{
    public const TYPE = 'channel.moderator.add';

    public function __construct(
        private string $broadcasterUserId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }
}
