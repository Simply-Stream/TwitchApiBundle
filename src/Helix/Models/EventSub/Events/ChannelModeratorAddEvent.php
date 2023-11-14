<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelModeratorAddEvent extends Event
{
    /**
     * @param string $broadcasterUserId    The requested broadcaster ID.
     * @param string $broadcasterUserLogin The requested broadcaster login.
     * @param string $broadcasterUserName  The requested broadcaster display name.
     * @param string $userId               The user ID of the new moderator.
     * @param string $userLogin            The user login of the new moderator.
     * @param string $userName             The display name of the new moderator.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $userId,
        private string $userLogin,
        private string $userName,
    ) {
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

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getUserName(): string {
        return $this->userName;
    }
}
