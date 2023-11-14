<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelCheerEvent extends Event
{
    /**
     * @param bool        $isAnonymous          Whether the user cheered anonymously or not.
     * @param string      $broadcasterUserId    The requested broadcaster ID.
     * @param string      $broadcasterUserLogin The requested broadcaster login.
     * @param string      $broadcasterUserName  The requested broadcaster display name.
     * @param string      $message              The message sent with the cheer.
     * @param int         $bits                 The number of bits cheered.
     * @param string|null $userId               The user ID for the user who cheered on the specified channel. This is null if is_anonymous
     *                                          is true.
     * @param string|null $userLogin            The user login for the user who cheered on the specified channel. This is null if
     *                                          is_anonymous is true.
     * @param string|null $userName             The user display name for the user who cheered on the specified channel. This is null if
     *                                          is_anonymous is true.
     */
    public function __construct(
        private bool $isAnonymous,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $message,
        private int $bits,
        private ?string $userId = null,
        private ?string $userLogin = null,
        private ?string $userName = null,
    ) {
    }

    public function isAnonymous(): bool {
        return $this->isAnonymous;
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

    public function getMessage(): string {
        return $this->message;
    }

    public function getBits(): int {
        return $this->bits;
    }
}
