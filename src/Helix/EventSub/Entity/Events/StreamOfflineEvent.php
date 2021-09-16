<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class StreamOfflineEvent extends AbstractEvent
{
    use HasBroadcasterUser;
}
