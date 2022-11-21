<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions
 */
class ChannelPointsCustomRewardUpdateCondition extends AbstractCondition
{
    public const TYPE = 'channel.channel_points_custom_reward.update';

    /**
     * @var string
     */
    protected string $broadcasterUserId;

    /**
     * @var string|null
     */
    protected ?string $rewardId;

    /**
     * @return string
     */
    public function getBroadcasterUserId(): string
    {
        return $this->broadcasterUserId;
    }

    /**
     * @return string|null
     */
    public function getRewardId(): ?string
    {
        return $this->rewardId;
    }
}
