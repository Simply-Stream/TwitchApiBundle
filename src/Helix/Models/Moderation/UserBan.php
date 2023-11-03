<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Moderation;

final readonly class UserBan
{
    /**
     * @param string             $broadcasterId The broadcaster whose chat room the user was banned from chatting in.
     * @param string             $moderatorId   The moderator that banned or put the user in the timeout.
     * @param string             $userId        The user that was banned or put in a timeout.
     * @param \DateTimeImmutable $createdAt     The UTC date and time (in RFC3339 format) that the ban or timeout was placed.
     * @param \DateTimeImmutable $endTime       The UTC date and time (in RFC3339 format) that the timeout will end. Is null if the user
     *                                          was banned instead of being put in a timeout.
     */
    public function __construct(
        private string $broadcasterId,
        private string $moderatorId,
        private string $userId,
        private \DateTimeImmutable $createdAt,
        private \DateTimeImmutable $endTime
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getModeratorId(): string {
        return $this->moderatorId;
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getEndTime(): \DateTimeImmutable {
        return $this->endTime;
    }
}
