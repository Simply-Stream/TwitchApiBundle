<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class UserUpdateEvent extends Event
{
    /**
     * @param string      $userId        The user’s user id.
     * @param string      $userLogin     The user’s user login.
     * @param string      $userName      The user’s user display name.
     * @param bool        $emailVerified A Boolean value that determines whether Twitch has verified the user’s email address. Is true if
     *                                   Twitch has verified the email address; otherwise, false. NOTE: Ignore this field if the email
     *                                   field contains an empty string.
     * @param string      $description   The user’s description.
     * @param string|null $email         The user’s email address. The event includes the user’s email address only if the app used to
     *                                   request this event type includes the user:read:email scope for the user; otherwise, the field is
     *                                   set to an empty string. See Create EventSub Subscription.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
        private bool $emailVerified,
        private string $description,
        private ?string $email = null,
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

    public function isEmailVerified(): bool {
        return $this->emailVerified;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getEmail(): ?string {
        return $this->email;
    }
}
