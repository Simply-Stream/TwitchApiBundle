<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelFollowEvent extends Event
{
    /**
     * @param string             $userId               The user ID for the user now following the specified channel.
     * @param string             $userLogin            The user login for the user now following the specified channel.
     * @param string             $userName             The user display name for the user now following the specified channel.
     * @param string             $broadcasterUserId    The requested broadcaster ID.
     * @param string             $broadcasterUserLogin The requested broadcaster login.
     * @param string             $broadcasterUserName  The requested broadcaster display name.
     * @param \DateTimeImmutable $followedAt           RFC3339 timestamp of when the follow occurred.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private \DateTimeImmutable $followedAt
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
    }

    public function getFollowedAt(): \DateTimeImmutable {
        return $this->followedAt;
    }
}
