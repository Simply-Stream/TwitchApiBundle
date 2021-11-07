<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelModeratorRemoveEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;
}
