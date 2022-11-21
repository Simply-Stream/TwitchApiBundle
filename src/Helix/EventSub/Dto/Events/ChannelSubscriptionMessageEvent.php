<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Message;

class ChannelSubscriptionMessageEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;

    /**
     * @var string
     */
    protected $tier;

    /**
     * @var Message
     */
    protected $message;

    /**
     * @var int
     */
    protected $cumulativeMonths;

    /**
     * @var int
     */
    protected $streakMonths;

    /**
     * @var int
     */
    protected $durationMonths;

    /**
     * @return string
     */
    public function getTier(): string
    {
        return $this->tier;
    }

    /**
     * @param string $tier
     *
     * @return $this
     */
    public function setTier(string $tier): self
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @param Message $message
     *
     * @return $this
     */
    public function setMessage(Message $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getCumulativeMonths(): int
    {
        return $this->cumulativeMonths;
    }

    /**
     * @param int $cumulativeMonths
     *
     * @return $this
     */
    public function setCumulativeMonths(int $cumulativeMonths): self
    {
        $this->cumulativeMonths = $cumulativeMonths;

        return $this;
    }

    /**
     * @return int
     */
    public function getStreakMonths(): int
    {
        return $this->streakMonths;
    }

    /**
     * @param int $streakMonths
     *
     * @return $this
     */
    public function setStreakMonths(int $streakMonths): self
    {
        $this->streakMonths = $streakMonths;

        return $this;
    }

    /**
     * @return int
     */
    public function getDurationMonths(): int
    {
        return $this->durationMonths;
    }

    /**
     * @param int $durationMonths
     *
     * @return $this
     */
    public function setDurationMonths(int $durationMonths): self
    {
        $this->durationMonths = $durationMonths;

        return $this;
    }
}
