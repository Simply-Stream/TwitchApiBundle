<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Channels;

final readonly class FollowedChannel
{
    /**
     * @param string             $broadcasterId    An ID that uniquely identifies the broadcaster that this user is following.
     * @param string             $broadcasterLogin The broadcaster’s login name.
     * @param string             $broadcasterName  The broadcaster’s display name.
     * @param \DateTimeImmutable $followedAt       The UTC timestamp when the user started following the broadcaster.
     */
    public function __construct(
        private string $broadcasterId,
        private string $broadcasterLogin,
        private string $broadcasterName,
        private \DateTimeImmutable $followedAt
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getFollowedAt(): \DateTimeImmutable {
        return $this->followedAt;
    }
}
