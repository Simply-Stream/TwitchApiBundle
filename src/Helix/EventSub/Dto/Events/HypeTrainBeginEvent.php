<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use JMS\Serializer\Annotation as Serializer;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Contribution;

class HypeTrainBeginEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var int
     */
    protected int $total;

    /**
     * @var int
     */
    protected int $progress;

    /**
     * @var int
     */
    protected int $goal;

    /**
     * @var array<Contribution>
     * @Serializer\Type("array<SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Contribution>")
     */
    protected array $topContributions;

    /**
     * @var Contribution
     */
    protected Contribution $lastContribution;

    /**
     * @var string
     */
    protected string $startedAt;

    /**
     * @var string
     */
    protected string $expiresAt;

    /**
     * @var int 
     */
    protected int $level;

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
     * @return string
     */
    public function getStartedAt(): string
    {
        return $this->startedAt;
    }

    /**
     * @param string $startedAt
     *
     * @return $this
     */
    public function setStartedAt(string $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getExpiresAt(): string
    {
        return $this->expiresAt;
    }

    /**
     * @param string $expiresAt
     *
     * @return $this
     */
    public function setExpiresAt(string $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

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
     * @return HypeTrainBeginEvent
     */
    public function setLevel(int $level): HypeTrainBeginEvent
    {
        $this->level = $level;

        return $this;
    }
}
