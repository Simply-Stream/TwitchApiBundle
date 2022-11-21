<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelBanEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser,
        HasModeratorUser;

    /**
     * @var string
     */
    protected string $reason;

    /**
     * @var \DateTime
     */
    protected \DateTime $endsAt;

    /**
     * @var bool
     */
    protected bool $isPermanent;

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
    public function isIsPermanent(): bool
    {
        return $this->isPermanent;
    }

    /**
     * @param bool $isPermanent
     *
     * @return ChannelBanEvent
     */
    public function setIsPermanent(bool $isPermanent): ChannelBanEvent
    {
        $this->isPermanent = $isPermanent;

        return $this;
    }
}
