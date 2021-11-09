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
    protected $isGift;

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
    public function isIsGift(): bool
    {
        return $this->isGift;
    }

    /**
     * @param bool $isGift
     *
     * @return ChannelSubscribeEvent
     */
    public function setIsGift(bool $isGift): ChannelSubscribeEvent
    {
        $this->isGift = $isGift;

        return $this;
    }
}
