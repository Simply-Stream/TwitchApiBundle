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
    protected $toBroadcasterUserId;

    protected $requiredOptions = [
        'toBroadcasterUserId',
    ];

    /**
     * @return string
     */
    public function getToBroadcasterUserId(): string
    {
        return $this->toBroadcasterUserId;
    }
}
