<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelPollEndEvent extends ChannelPollBeginEvent
{
    public const POLL_STATUS_COMPLETED = 'completed';
    public const POLL_STATUS_ARCHIVED = 'archived';
    public const POLL_STATUS_TERMINATED = 'terminated';

    /**
     * @var string - Enum of following values: completed, archived, terminated
     */
    protected string $status;

    /**
     * @var string
     */
    protected string $endedAt;

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

    /**
     * @return string
     */
    public function getEndedAt(): string
    {
        return $this->endedAt;
    }

    /**
     * @param string $endedAt
     *
     * @return ChannelPollEndEvent
     */
    public function setEndedAt(string $endedAt): ChannelPollEndEvent
    {
        $this->endedAt = $endedAt;

        return $this;
    }
}
