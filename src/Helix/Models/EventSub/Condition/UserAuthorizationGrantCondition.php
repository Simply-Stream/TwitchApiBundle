<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class UserAuthorizationGrantCondition implements ConditionInterface
{
    public const TYPE = 'user.authorization.grant';

    public function __construct(
        private string $clientId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getClientId(): string {
        return $this->clientId;
    }
}
