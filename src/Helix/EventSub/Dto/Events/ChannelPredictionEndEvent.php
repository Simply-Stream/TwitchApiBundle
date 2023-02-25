<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelPredictionEndEvent extends ChannelPredictionBeginEvent
{
    /**
     * @var string
     */
    protected string $winningOutcomeId;

    /**
     * @var string
     */
    protected string $endedAt;

    /**
     * The status of the Channel Points Prediction. Valid values are resolved and canceled.
     *
     * @var string
     */
    protected string $status;

    /**
     * @return string
     */
    public function getWinningOutcomeId(): string
    {
        return $this->winningOutcomeId;
    }

    /**
     * @param string $winningOutcomeId
     *
     * @return $this
     */
    public function setWinningOutcomeId(string $winningOutcomeId): self
    {
        $this->winningOutcomeId = $winningOutcomeId;

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
     * @return ChannelPredictionEndEvent
     */
    public function setEndedAt(string $endedAt): ChannelPredictionEndEvent
    {
        $this->endedAt = $endedAt;

        return $this;
    }

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
     * @return ChannelPredictionEndEvent
     */
    public function setStatus(string $status): ChannelPredictionEndEvent
    {
        $this->status = $status;

        return $this;
    }
}
