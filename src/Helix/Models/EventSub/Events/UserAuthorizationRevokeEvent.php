<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class UserAuthorizationRevokeEvent extends Event
{
    /**
     * @param string      $clientId  The client_id of the application with revoked user access.
     * @param string      $userId    The user id for the user who has revoked authorization for your client id.
     * @param string|null $userLogin The user login for the user who has revoked authorization for your client id. This is null if the user
     *                               no longer exists.
     * @param string|null $userName  The user display name for the user who has revoked authorization for your client id. This is null if
     *                               the user no longer exists.
     */
    public function __construct(
        private string $clientId,
        private string $userId,
        private ?string $userLogin = null,
        private ?string $userName = null
    ) {
    }

    public function getClientId(): string {
        return $this->clientId;
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserLogin(): ?string {
        return $this->userLogin;
    }

    public function getUserName(): ?string {
        return $this->userName;
    }
}
