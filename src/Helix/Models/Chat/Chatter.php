<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Chat;

final readonly class Chatter
{
    /**
     * @param string $userId    The ID of a user that’s connected to the broadcaster’s chat room.
     * @param string $userLogin The user’s login name.
     * @param string $userName  The user’s display name.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName
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
