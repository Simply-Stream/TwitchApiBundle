<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelGoalBeginEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var string
     */
    protected string $description;

    /**
     * @var bool
     */
    protected bool $isAchieved;

    /**
     * @var int
     */
    protected int $currentAmount;

    /**
     * @var int
     */
    protected int $targetAmount;

    /**
     * @var string
     */
    protected string $startedAt;

    /**
     * @var string
     */
    protected string $endedAt;

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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsAchieved(): bool
    {
        return $this->isAchieved;
    }

    /**
     * @param bool $isAchieved
     *
     * @return $this
     */
    public function setIsAchieved(bool $isAchieved): self
    {
        $this->isAchieved = $isAchieved;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentAmount(): int
    {
        return $this->currentAmount;
    }

    /**
     * @param int $currentAmount
     *
     * @return $this
     */
    public function setCurrentAmount(int $currentAmount): self
    {
        $this->currentAmount = $currentAmount;

        return $this;
    }

    /**
     * @return int
     */
    public function getTargetAmount(): int
    {
        return $this->targetAmount;
    }

    /**
     * @param int $targetAmount
     *
     * @return $this
     */
    public function setTargetAmount(int $targetAmount): self
    {
        $this->targetAmount = $targetAmount;

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
    public function getEndedAt(): string
    {
        return $this->endedAt;
    }

    /**
     * @param string $endedAt
     *
     * @return $this
     */
    public function setEndedAt(string $endedAt): self
    {
        $this->endedAt = $endedAt;

        return $this;
    }
}
