<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class ChannelPointsCustomRewardRemoveCondition implements ConditionInterface
{
    public const TYPE = 'channel.channel_points_custom_reward.remove';

    public function __construct(
        private string $broadcasterUserId,
        private string $rewardId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getRewardId(): string {
        return $this->rewardId;
    }
}
