<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelBanEvent extends Event
{
    /**
     * @param string                  $userId               The user ID for the user who was banned on the specified channel.
     * @param string                  $userLogin            The user login for the user who was banned on the specified channel.
     * @param string                  $userName             The user display name for the user who was banned on the specified channel.
     * @param string                  $broadcasterUserId    The requested broadcaster ID.
     * @param string                  $broadcasterUserLogin The requested broadcaster login.
     * @param string                  $broadcasterUserName  The requested broadcaster display name.
     * @param string                  $moderatorUserId      The user ID of the issuer of the ban.
     * @param string                  $moderatorUserLogin   The user login of the issuer of the ban.
     * @param string                  $moderatorUserName    The user name of the issuer of the ban.
     * @param string                  $reason               The reason behind the ban.
     * @param \DateTimeImmutable      $bannedAt             The UTC date and time (in RFC3339 format) of when the user was banned or put in
     *                                                      a timeout.
     * @param bool                    $isPermanent          Indicates whether the ban is permanent (true) or a timeout (false). If true,
     *                                                      ends_at will be null.
     * @param \DateTimeImmutable|null $endsAt               The UTC date and time (in RFC3339 format) of when the timeout ends. Is null if
     *                                                      the user was banned instead of put in a timeout.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $moderatorUserId,
        private string $moderatorUserLogin,
        private string $moderatorUserName,
        private string $reason,
        private \DateTimeImmutable $bannedAt,
        private bool $isPermanent,
        private ?\DateTimeImmutable $endsAt = null
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

    public function getModeratorUserId(): string {
        return $this->moderatorUserId;
    }

    public function getModeratorUserLogin(): string {
        return $this->moderatorUserLogin;
    }

    public function getModeratorUserName(): string {
        return $this->moderatorUserName;
    }

    public function getReason(): string {
        return $this->reason;
    }

    public function getBannedAt(): \DateTimeImmutable {
        return $this->bannedAt;
    }

    public function isPermanent(): bool {
        return $this->isPermanent;
    }

    public function getEndsAt(): ?\DateTimeImmutable {
        return $this->endsAt;
    }
}
