<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Moderation;

final readonly class Moderator
{
    /**
     * @param string $userId    The ID of the user that has permission to moderate the broadcaster’s channel.
     * @param string $userLogin The user’s login name.
     * @param string $userName  The user’s display name.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
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
}
