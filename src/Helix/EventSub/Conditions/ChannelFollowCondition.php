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
class ChannelFollowCondition extends AbstractCondition
{
    public const TYPE = 'channel.follow';

    /**
     * @var string
     */
    protected string $broadcasterUserId;

    /**
     * @var string
     */
    protected string $moderatorUserId;

    /**
     * @return string
     */
    public function getBroadcasterUserId(): string
    {
        return $this->broadcasterUserId;
    }

    /**
     * @return string
     */
    public function getModeratorUserId(): string
    {
        return $this->moderatorUserId;
    }
}
