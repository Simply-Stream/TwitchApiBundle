<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelPredictionEndEvent extends ChannelPredictionBeginEvent
{
    /**
     * @var string
     */
    protected $winningOutcomeId;

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
}
