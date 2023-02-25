<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelPredictionLockEvent extends ChannelPredictionBeginEvent
{
    protected string $lockedAt;

    /**
     * @return string
     */
    public function getLockedAt(): string
    {
        return $this->lockedAt;
    }

    /**
     * @param string $lockedAt
     *
     * @return $this
     */
    public function setLockedAt(string $lockedAt): self
    {
        $this->lockedAt = $lockedAt;

        return $this;
    }
}
