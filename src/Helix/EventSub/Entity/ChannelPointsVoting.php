<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity;

class ChannelPointsVoting
{
    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var int
     */
    protected $amountPerVote;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

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
