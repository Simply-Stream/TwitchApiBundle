<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class HypeTrainBeginEvent extends AbstractEvent
{
    use HasBroadcasterUser;

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
    protected $lastContributions;

    /**
     * @var \DateTime
     */
    protected $tartedAt;

    /**
     * @var \DateTime
     */
    protected $expiresAt;

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
     * @return HypeTrainBeginEvent
     */
    public function setTotal(int $total): HypeTrainBeginEvent
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
     * @return HypeTrainBeginEvent
     */
    public function setProgress(int $progress): HypeTrainBeginEvent
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
     * @return HypeTrainBeginEvent
     */
    public function setGoal(int $goal): HypeTrainBeginEvent
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
     * @return HypeTrainBeginEvent
     */
    public function setTopContributions(string $topContributions): HypeTrainBeginEvent
    {
        $this->topContributions = $topContributions;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastContributions(): string
    {
        return $this->lastContributions;
    }

    /**
     * @param string $lastContributions
     *
     * @return HypeTrainBeginEvent
     */
    public function setLastContributions(string $lastContributions): HypeTrainBeginEvent
    {
        $this->lastContributions = $lastContributions;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTartedAt(): \DateTime
    {
        return $this->tartedAt;
    }

    /**
     * @param \DateTime $tartedAt
     *
     * @return HypeTrainBeginEvent
     */
    public function setTartedAt(\DateTime $tartedAt): HypeTrainBeginEvent
    {
        $this->tartedAt = $tartedAt;

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
     * @return HypeTrainBeginEvent
     */
    public function setExpiresAt(\DateTime $expiresAt): HypeTrainBeginEvent
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
