<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class StreamOnlineEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return StreamOnlineEvent
     */
    public function setId(int $id): StreamOnlineEvent
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
     * @return StreamOnlineEvent
     */
    public function setType(string $type): StreamOnlineEvent
    {
        $this->type = $type;

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
     * @return StreamOnlineEvent
     */
    public function setStartedAt(\DateTime $startedAt): StreamOnlineEvent
    {
        $this->startedAt = $startedAt;

        return $this;
    }
}
