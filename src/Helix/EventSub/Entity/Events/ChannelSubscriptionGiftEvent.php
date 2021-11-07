<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelSubscriptionGiftEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;

    /**
     * @var int
     */
    protected $total;

    /**
     * @var string
     */
    protected $tier;

    /**
     * Null if not shared by user
     *
     * @var ?int
     */
    protected $cumulativeTotal;

    /**
     * @var bool
     */
    protected $anonymous;

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     *
     * @return $this
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return string
     */
    public function getTier(): string
    {
        return $this->tier;
    }

    /**
     * @param string $tier
     *
     * @return $this
     */
    public function setTier(string $tier): self
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCumulativeTotal(): ?int
    {
        return $this->cumulativeTotal;
    }

    /**
     * @param int|null $cumulativeTotal
     *
     * @return $this
     */
    public function setCumulativeTotal(?int $cumulativeTotal): self
    {
        $this->cumulativeTotal = $cumulativeTotal;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAnonymous(): bool
    {
        return $this->anonymous;
    }

    /**
     * @param bool $anonymous
     *
     * @return $this
     */
    public function setAnonymous(bool $anonymous): self
    {
        $this->anonymous = $anonymous;

        return $this;
    }
}
