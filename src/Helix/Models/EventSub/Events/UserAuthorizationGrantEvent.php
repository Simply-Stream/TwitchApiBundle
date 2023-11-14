<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class UserAuthorizationGrantEvent extends Event
{
    /**
     * @param string $clientId  The client_id of the application that was granted user access.
     * @param string $userId    The user id for the user who has granted authorization for your client id.
     * @param string $userLogin The user login for the user who has granted authorization for your client id.
     * @param string $userName  The user display name for the user who has granted authorization for your client id.
     */
    public function __construct(
        private string $clientId,
        private string $userId,
        private string $userLogin,
        private string $userName
    ) {
    }

    public function getClientId(): string {
        return $this->clientId;
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
