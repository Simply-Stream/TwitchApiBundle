<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions
 */
class ChannelSubscriptionEndCondition extends AbstractCondition
{
    public const TYPE = 'channel.subscription.end';

    /**
     * @var string
     */
    protected $broadcasterUserId;

    /**
     * @return string
     */
    public function getBroadcasterUserId(): string
    {
        return $this->broadcasterUserId;
    }
}
