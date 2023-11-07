<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class UserUpdateCondition implements ConditionInterface
{
    public const TYPE = 'user.update';

    public function __construct(
        private string $userId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getUserId(): string {
        return $this->userId;
    }
}
