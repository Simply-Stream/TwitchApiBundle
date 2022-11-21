<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Contribution;

class HypeTrainEndEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var int
     */
    protected $level;

    /**
     * @var int
     */
    protected $total;

    /**
     * @var Contribution[]
     */
    protected $topContributions;

    /**
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * @var \DateTime
     */
    protected $endedAt;

    /**
     * @var \DateTime
     */
    protected $cooldownEndsAt;

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     *
     * @return $this
     */
    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

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
     * @return array
     */
    public function getTopContributions(): array
    {
        return $this->topContributions;
    }

    /**
     * @param array $topContributions
     *
     * @return $this
     */
    public function setTopContributions(array $topContributions): self
    {
        $this->topContributions = $topContributions;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param \DateTime $startedAt
     *
     * @return $this
     */
    public function setStartedAt(\DateTime $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndedAt(): \DateTime
    {
        return $this->endedAt;
    }

    /**
     * @param \DateTime $endedAt
     *
     * @return $this
     */
    public function setEndedAt(\DateTime $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCooldownEndsAt(): \DateTime
    {
        return $this->cooldownEndsAt;
    }

    /**
     * @param \DateTime $cooldownEndsAt
     *
     * @return $this
     */
    public function setCooldownEndsAt(\DateTime $cooldownEndsAt): self
    {
        $this->cooldownEndsAt = $cooldownEndsAt;

        return $this;
    }
}
