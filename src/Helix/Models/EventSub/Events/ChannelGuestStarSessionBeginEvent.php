<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelGuestStarSessionBeginEvent extends Event
{
    /**
     * @param string             $broadcasterUserId    The broadcaster user ID
     * @param string             $broadcasterUserName  The broadcaster display name
     * @param string             $broadcasterUserLogin The broadcaster login
     * @param string             $sessionId            ID representing the unique session that was started.
     * @param \DateTimeImmutable $startedAt            RFC3339 timestamp indicating the time the session began.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserName,
        private string $broadcasterUserLogin,
        private string $sessionId,
        private \DateTimeImmutable $startedAt
    ) {
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getSessionId(): string {
        return $this->sessionId;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }
}
