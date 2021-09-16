<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

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
     * @TODO: Change to class
     *
     * @var string
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
     * @return HypeTrainEndEvent
     */
    public function setLevel(int $level): HypeTrainEndEvent
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
     * @return HypeTrainEndEvent
     */
    public function setTotal(int $total): HypeTrainEndEvent
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return string
     */
    public function getTopContributions(): string
    {
        return $this->topContributions;
    }

    /**
     * @param string $topContributions
     *
     * @return HypeTrainEndEvent
     */
    public function setTopContributions(string $topContributions): HypeTrainEndEvent
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
     * @return HypeTrainEndEvent
     */
    public function setStartedAt(\DateTime $startedAt): HypeTrainEndEvent
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
     * @return HypeTrainEndEvent
     */
    public function setEndedAt(\DateTime $endedAt): HypeTrainEndEvent
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
     * @return HypeTrainEndEvent
     */
    public function setCooldownEndsAt(\DateTime $cooldownEndsAt): HypeTrainEndEvent
    {
        $this->cooldownEndsAt = $cooldownEndsAt;

        return $this;
    }
}
