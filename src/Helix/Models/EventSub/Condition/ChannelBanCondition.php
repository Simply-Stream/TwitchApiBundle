<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class ChannelBanCondition implements ConditionInterface
{
    public const TYPE = 'channel.ban';

    /**
     * @param string $broadcasterUserId The broadcaster user ID for the channel you want to get ban notifications for.
     */
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
