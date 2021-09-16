<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelBanEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser,
        HasModeratorUser;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @var \DateTime
     */
    protected $endsAt;

    /**
     * @var bool
     */
    protected $permanent;

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }

    /**
     * @param string $reason
     *
     * @return ChannelBanEvent
     */
    public function setReason(string $reason): ChannelBanEvent
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndsAt(): \DateTime
    {
        return $this->endsAt;
    }

    /**
     * @param \DateTime $endsAt
     *
     * @return ChannelBanEvent
     */
    public function setEndsAt(\DateTime $endsAt): ChannelBanEvent
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPermanent(): bool
    {
        return $this->permanent;
    }

    /**
     * @param bool $permanent
     *
     * @return ChannelBanEvent
     */
    public function setPermanent(bool $permanent): ChannelBanEvent
    {
        $this->permanent = $permanent;

        return $this;
    }
}
