<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class HypeTrainProgressEvent extends AbstractEvent
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
     * @var int
     */
    protected $progress;

    /**
     * @var int
     */
    protected $goal;

    /**
     * @TODO: Change to class
     *
     * @var string
     */
    protected $topContributions;

    /**
     * @TODO: Change to class
     *
     * @var string
     */
    protected $lastContribution;

    /**
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * @var \DateTime
     */
    protected $expiresAt;

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
     * @return HypeTrainProgressEvent
     */
    public function setLevel(int $level): HypeTrainProgressEvent
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
     * @return HypeTrainProgressEvent
     */
    public function setTotal(int $total): HypeTrainProgressEvent
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     *
     * @return HypeTrainProgressEvent
     */
    public function setProgress(int $progress): HypeTrainProgressEvent
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * @return int
     */
    public function getGoal(): int
    {
        return $this->goal;
    }

    /**
     * @param int $goal
     *
     * @return HypeTrainProgressEvent
     */
    public function setGoal(int $goal): HypeTrainProgressEvent
    {
        $this->goal = $goal;

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
     * @return HypeTrainProgressEvent
     */
    public function setTopContributions(string $topContributions): HypeTrainProgressEvent
    {
        $this->topContributions = $topContributions;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastContribution(): string
    {
        return $this->lastContribution;
    }

    /**
     * @param string $lastContribution
     *
     * @return HypeTrainProgressEvent
     */
    public function setLastContribution(string $lastContribution): HypeTrainProgressEvent
    {
        $this->lastContribution = $lastContribution;

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
     * @return HypeTrainProgressEvent
     */
    public function setStartedAt(\DateTime $startedAt): HypeTrainProgressEvent
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt(): \DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param \DateTime $expiresAt
     *
     * @return HypeTrainProgressEvent
     */
    public function setExpiresAt(\DateTime $expiresAt): HypeTrainProgressEvent
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
