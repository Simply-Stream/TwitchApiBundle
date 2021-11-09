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
class ChannelRaidCondition extends AbstractCondition
{
    public const TYPE = 'channel.raid';

    /**
     * @var string
     */
    protected $fromBroadcasterUserId;

    /**
     * @var string
     */
    protected $toBroadcasterUserId;

    /**
     * There's actually no required option, but it still needs either from- or toBroadcasterUserId to work
     * @see https://dev.twitch.tv/docs/eventsub/eventsub-reference#channel-raid-condition
     *
     * @var array
     */
    protected $requiredOptions = [];

    /**
     * @return string
     */
    public function getFromBroadcasterUserId(): ?string
    {
        return $this->fromBroadcasterUserId;
    }

    /**
     * @return string
     */
    public function getToBroadcasterUserId(): ?string
    {
        return $this->toBroadcasterUserId;
    }
}
