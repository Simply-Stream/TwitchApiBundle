<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelSubscribeEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;

    /**
     * @var string
     */
    protected $tier;

    /**
     * @var bool
     */
    protected $gift;

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
     * @return ChannelSubscribeEvent
     */
    public function setTier(string $tier): ChannelSubscribeEvent
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * @return bool
     */
    public function isGift(): bool
    {
        return $this->gift;
    }

    /**
     * @param bool $gift
     *
     * @return ChannelSubscribeEvent
     */
    public function setGift(bool $gift): ChannelSubscribeEvent
    {
        $this->gift = $gift;

        return $this;
    }
}
