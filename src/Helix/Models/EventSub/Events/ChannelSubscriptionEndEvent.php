<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelSubscriptionEndEvent extends Event
{
    /**
     * @param string $userId               The user ID for the user whose subscription ended.
     * @param string $userLogin            The user login for the user whose subscription ended.
     * @param string $userName             The user display name for the user whose subscription ended.
     * @param string $broadcasterUserId    The broadcaster user ID.
     * @param string $broadcasterUserLogin The broadcaster login.
     * @param string $broadcasterUserName  The broadcaster display name.
     * @param string $tier                 The tier of the subscription that ended. Valid values are 1000, 2000, and 3000.
     * @param bool   $isGift               Whether the subscription was a gift.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $tier,
        private bool $isGift
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

    public function getTier(): string {
        return $this->tier;
    }

    public function isGift(): bool {
        return $this->isGift;
    }
}
