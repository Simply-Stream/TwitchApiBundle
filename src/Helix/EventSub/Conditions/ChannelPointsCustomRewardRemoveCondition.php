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
class ChannelPointsCustomRewardRemoveCondition extends AbstractCondition
{
    public const TYPE = 'channel.channel_points_custom_reward.remove';

    /**
     * @var string
     */
    protected $broadcasterUserId;

    /**
     * @var string|null
     */
    protected $rewardId;

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
