<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions
 */
class ChannelSubscriptionMessageCondition extends AbstractCondition
{
    public const TYPE = 'channel.subscription.message';

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
