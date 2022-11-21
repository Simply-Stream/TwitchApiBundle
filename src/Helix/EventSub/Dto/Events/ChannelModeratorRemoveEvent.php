<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelModeratorRemoveEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;
}
