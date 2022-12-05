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
class ChannelBanCondition extends AbstractCondition
{
    public const TYPE = 'channel.ban';

    /**
     * @var string
     */
    protected string $broadcasterUserId;

    /**
     * @return string
     */
    public function getBroadcasterUserId(): string
    {
        return $this->broadcasterUserId;
    }
}
