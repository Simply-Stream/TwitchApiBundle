<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelUnbanEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser,
        HasModeratorUser;
}
