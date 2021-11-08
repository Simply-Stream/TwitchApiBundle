<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelModeratorAddEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;
}
