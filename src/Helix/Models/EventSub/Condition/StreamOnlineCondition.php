<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class StreamOnlineCondition implements ConditionInterface
{
    use SerializesModels;

    public const TYPE = 'stream.online';

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
