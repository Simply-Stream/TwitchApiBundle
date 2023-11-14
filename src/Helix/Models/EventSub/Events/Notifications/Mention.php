<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Mention
{
    use SerializesModels;

    /**
     * @param string $userId    The user ID of the mentioned user.
     * @param string $userName  The user name of the mentioned user.
     * @param string $userLogin The user login of the mentioned user.
     */
    public function __construct(
        private string $userId,
        private string $userName,
        private string $userLogin
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }
}
