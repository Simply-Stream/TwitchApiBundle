<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelSubscriptionGiftEvent extends Event
{
    /**
     * @param string      $broadcasterUserId    The broadcaster user ID.
     * @param string      $broadcasterUserLogin The broadcaster login.
     * @param string      $broadcasterUserName  The broadcaster display name.
     * @param int         $total                The number of subscriptions in the subscription gift.
     * @param string      $tier                 The tier of subscriptions in the subscription gift.
     * @param bool        $isAnonymous          Whether the subscription gift was anonymous.
     * @param string|null $userId               The user ID of the user who sent the subscription gift. Set to null if it was an anonymous
     *                                          subscription gift.
     * @param string|null $userLogin            The user login of the user who sent the gift. Set to null if it was an anonymous
     *                                          subscription gift.
     * @param string|null $userName             The user display name of the user who sent the gift. Set to null if it was an anonymous
     *                                          subscription gift.
     * @param int|null    $cumulativeTotal      The number of subscriptions gifted by this user in the channel. This value is null for
     *                                          anonymous gifts or if the gifter has opted out of sharing this information.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private int $total,
        private string $tier,
        private bool $isAnonymous,
        private ?string $userId = null,
        private ?string $userLogin = null,
        private ?string $userName = null,
        private ?int $cumulativeTotal = null
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

    public function getTotal(): int {
        return $this->total;
    }

    public function getTier(): string {
        return $this->tier;
    }

    public function isAnonymous(): bool {
        return $this->isAnonymous;
    }

    public function getUserId(): ?string {
        return $this->userId;
    }

    public function getUserLogin(): ?string {
        return $this->userLogin;
    }

    public function getUserName(): ?string {
        return $this->userName;
    }

    public function getCumulativeTotal(): ?int {
        return $this->cumulativeTotal;
    }
}
