<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelSubscriptionMessageEvent extends Event
{
    /**
     * @param string   $userId               The user ID of the user who sent a resubscription chat message.
     * @param string   $userLogin            The user login of the user who sent a resubscription chat message.
     * @param string   $userName             The user display name of the user who a resubscription chat message.
     * @param string   $broadcasterUserId    The broadcaster user ID.
     * @param string   $broadcasterUserLogin The broadcaster login.
     * @param string   $broadcasterUserName  The broadcaster display name.
     * @param string   $tier                 The tier of the user’s subscription.
     * @param Message  $message              An object that contains the resubscription message and emote information needed to recreate the
     *                                       message.
     * @param int      $cumulativeMonths     The total number of months the user has been subscribed to the channel.
     * @param int      $durationMonths       The month duration of the subscription.
     * @param int|null $streakMonths         The number of consecutive months the user’s current subscription has been active. This value is
     *                                       null if the user has opted out of sharing this information.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $tier,
        private Message $message,
        private int $cumulativeMonths,
        private int $durationMonths,
        private ?int $streakMonths = null
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

    public function getMessage(): Message {
        return $this->message;
    }

    public function getCumulativeMonths(): int {
        return $this->cumulativeMonths;
    }

    public function getDurationMonths(): int {
        return $this->durationMonths;
    }

    public function getStreakMonths(): ?int {
        return $this->streakMonths;
    }
}
