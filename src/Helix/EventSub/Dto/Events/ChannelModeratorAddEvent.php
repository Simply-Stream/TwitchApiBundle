<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelModeratorAddEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;
}
