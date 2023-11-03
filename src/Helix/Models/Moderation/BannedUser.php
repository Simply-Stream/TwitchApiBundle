<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Moderation;

final readonly class BannedUser
{
    /**
     * @param string             $userId         The ID of the banned user.
     * @param string             $userLogin      The banned user’s login name.
     * @param string             $userName       The banned user’s display name.
     * @param \DateTimeImmutable $expiresAt      The UTC date and time (in RFC3339 format) of when the timeout expires, or an empty string
     *                                           if the user is permanently banned.
     * @param \DateTimeImmutable $createdAt      The UTC date and time (in RFC3339 format) of when the user was banned.
     * @param string             $reason         The reason the user was banned or put in a timeout if the moderator provided one.
     * @param string             $moderatorId    The ID of the moderator that banned the user or put them in a timeout.
     * @param string             $moderatorLogin The moderator’s login name.
     * @param string             $moderatorName  The moderator’s display name.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
        private \DateTimeImmutable $expiresAt,
        private \DateTimeImmutable $createdAt,
        private string $reason,
        private string $moderatorId,
        private string $moderatorLogin,
        private string $moderatorName,
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

    public function getExpiresAt(): \DateTimeImmutable {
        return $this->expiresAt;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getReason(): string {
        return $this->reason;
    }

    public function getModeratorId(): string {
        return $this->moderatorId;
    }

    public function getModeratorLogin(): string {
        return $this->moderatorLogin;
    }

    public function getModeratorName(): string {
        return $this->moderatorName;
    }
}
