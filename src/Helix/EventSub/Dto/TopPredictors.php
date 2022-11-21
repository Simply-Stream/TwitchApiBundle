<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events\HasUser;

class TopPredictors
{
    use HasUser;

    /**
     * @var ?int
     */
    protected ?int $channelPointsWon;

    /**
     * @var int
     */
    protected int $channelPointsUsed;

    /**
     * @return int|null
     */
    public function getChannelPointsWon(): ?int
    {
        return $this->channelPointsWon;
    }

    /**
     * @param int|null $channelPointsWon
     *
     * @return $this
     */
    public function setChannelPointsWon(?int $channelPointsWon): self
    {
        $this->channelPointsWon = $channelPointsWon;

        return $this;
    }

    /**
     * @return int
     */
    public function getChannelPointsUsed(): int
    {
        return $this->channelPointsUsed;
    }

    /**
     * @param int $channelPointsUsed
     *
     * @return $this
     */
    public function setChannelPointsUsed(int $channelPointsUsed): self
    {
        $this->channelPointsUsed = $channelPointsUsed;

        return $this;
    }
}
