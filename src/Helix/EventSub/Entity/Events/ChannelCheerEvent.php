<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelCheerEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;

    /**
     * @var bool
     */
    protected $isAnonymous;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $bits;

    /**
     * @return bool
     */
    public function isIsAnonymous(): bool
    {
        return $this->isAnonymous;
    }

    /**
     * @param bool $isAnonymous
     *
     * @return ChannelCheerEvent
     */
    public function setIsAnonymous(bool $isAnonymous): ChannelCheerEvent
    {
        $this->isAnonymous = $isAnonymous;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return ChannelCheerEvent
     */
    public function setMessage(string $message): ChannelCheerEvent
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getBits(): int
    {
        return $this->bits;
    }

    /**
     * @param int $bits
     *
     * @return ChannelCheerEvent
     */
    public function setBits(int $bits): ChannelCheerEvent
    {
        $this->bits = $bits;

        return $this;
    }
}
