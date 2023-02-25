<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use JMS\Serializer\Annotation as Serializer;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Contribution;

class HypeTrainEndEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var int
     */
    protected int $level;

    /**
     * @var int
     */
    protected int $total;

    /**
     * @var array<Contribution>
     * @Serializer\Type("array<SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Contribution>")
     */
    protected array $topContributions;

    /**
     * @var string
     */
    protected string $startedAt;

    /**
     * @var string
     */
    protected string $endedAt;

    /**
     * @var string
     */
    protected string $cooldownEndsAt;

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

    /**
     * @return string
     */
    public function getCooldownEndsAt(): string
    {
        return $this->cooldownEndsAt;
    }

    /**
     * @param string $cooldownEndsAt
     *
     * @return $this
     */
    public function setCooldownEndsAt(string $cooldownEndsAt): self
    {
        $this->cooldownEndsAt = $cooldownEndsAt;

        return $this;
    }
}
