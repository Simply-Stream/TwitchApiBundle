<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

class ChannelPointsVoting
{
    /**
     * @var bool
     */
    protected bool $isEnabled;

    /**
     * @var int
     */
    protected int $amountPerVote;

    /**
     * @return bool
     */
    public function isIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmountPerVote(): int
    {
        return $this->amountPerVote;
    }

    /**
     * @param int $amountPerVote
     *
     * @return $this
     */
    public function setAmountPerVote(int $amountPerVote): self
    {
        $this->amountPerVote = $amountPerVote;

        return $this;
    }
}
