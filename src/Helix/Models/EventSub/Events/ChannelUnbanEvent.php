<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelUnbanEvent extends Event
{
    /**
     * @param string $userId               The user id for the user who was unbanned on the specified channel.
     * @param string $userLogin            The user login for the user who was unbanned on the specified channel.
     * @param string $userName             The user display name for the user who was unbanned on the specified channel.
     * @param string $broadcasterUserId    The requested broadcaster ID.
     * @param string $broadcasterUserLogin The requested broadcaster login.
     * @param string $broadcasterUserName  The requested broadcaster display name.
     * @param string $moderatorUserId      The user ID of the issuer of the unban.
     * @param string $moderatorUserLogin   The user login of the issuer of the unban.
     * @param string $moderatorUserName    The user name of the issuer of the unban.
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
}
