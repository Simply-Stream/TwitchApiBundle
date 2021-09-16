<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelFollowEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;
}
