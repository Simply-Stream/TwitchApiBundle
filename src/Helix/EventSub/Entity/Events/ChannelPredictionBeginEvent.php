<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Outcome;

class ChannelPredictionBeginEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var Outcome[]
     */
    protected $outcomes;

    /**
     * @var string
     */
    protected $startedAt;

    /**
     * @var string
     */
    protected $locksAt;

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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Outcome[]
     */
    public function getOutcomes(): array
    {
        return $this->outcomes;
    }

    /**
     * @param Outcome[] $outcomes
     *
     * @return $this
     */
    public function setOutcomes(array $outcomes): self
    {
        $this->outcomes = $outcomes;

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
    public function getLocksAt(): string
    {
        return $this->locksAt;
    }

    /**
     * @param string $locksAt
     *
     * @return $this
     */
    public function setLocksAt(string $locksAt): self
    {
        $this->locksAt = $locksAt;

        return $this;
    }
}
