<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Contribution;

class HypeTrainBeginEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var string
     */
    protected $id;

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
     * @var Contribution[]
     */
    protected $topContributions;

    /**
     * @var Contribution
     */
    protected $lastContribution;

    /**
     * @var \DateTime
     */
    protected $tartedAt;

    /**
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;

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
     * @return int
     */
    public function getProgress(): int
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     *
     * @return $this
     */
    public function setProgress(int $progress): self
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
     * @return $this
     */
    public function setGoal(int $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * @return Contribution[]
     */
    public function getTopContributions(): array
    {
        return $this->topContributions;
    }

    /**
     * @param Contribution[] $topContributions
     *
     * @return $this
     */
    public function setTopContributions(array $topContributions): self
    {
        $this->topContributions = $topContributions;

        return $this;
    }

    /**
     * @return Contribution
     */
    public function getLastContribution(): Contribution
    {
        return $this->lastContribution;
    }

    /**
     * @param string $lastContribution
     *
     * @return $this
     */
    public function setLastContribution(string $lastContribution): self
    {
        $this->lastContribution = $lastContribution;

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
     * @return $this
     */
    public function setTartedAt(\DateTime $tartedAt): self
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
     * @return $this
     */
    public function setExpiresAt(\DateTime $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }
}
