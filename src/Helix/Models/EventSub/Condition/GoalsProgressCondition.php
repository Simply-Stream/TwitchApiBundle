<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class GoalsProgressCondition implements ConditionInterface
{
    public const TYPE = 'channel.goal.progress';

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
