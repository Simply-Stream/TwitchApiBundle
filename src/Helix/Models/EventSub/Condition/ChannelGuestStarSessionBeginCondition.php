<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class ChannelGuestStarSessionBeginCondition implements ConditionInterface
{
    public const TYPE = 'channel.guest_star_session.begin';

    public function __construct(
        private string $broadcasterUserId,
        private string $moderatorUserId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getModeratorUserId(): string {
        return $this->moderatorUserId;
    }
}
