<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class ChannelRaidCondition implements ConditionInterface
{
    public const TYPE = 'channel.raid';

    public function __construct(
        private string $fromBroadcasterUserId,
        private string $toBroadcasterUserId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getFromBroadcasterUserId(): string {
        return $this->fromBroadcasterUserId;
    }

    public function getToBroadcasterUserId(): string {
        return $this->toBroadcasterUserId;
    }
}
