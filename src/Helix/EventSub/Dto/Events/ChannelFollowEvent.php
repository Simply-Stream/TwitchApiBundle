<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelFollowEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;

    /**
     * RFC3339 timestamp
     *
     * @var string
     */
    protected $followedAt;

    /**
     * @return string
     */
    public function getFollowedAt(): string
    {
        return $this->followedAt;
    }

    /**
     * @param string $followedAt
     *
     * @return $this
     */
    public function setFollowedAt(string $followedAt): self
    {
        $this->followedAt = $followedAt;

        return $this;
    }
}
