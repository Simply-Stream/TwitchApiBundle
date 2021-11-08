<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelPollEndEvent extends ChannelPollBeginEvent
{
    const POLL_STATUS_COMPLETED = 'completed';
    const POLL_STATUS_ARCHIVED = 'archived';
    const POLL_STATUS_TERMINATED = 'terminated';

    /**
     * @var string - Enum of following values: completed, archived, terminated
     */
    protected $status;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
