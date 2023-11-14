<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\ChannelPoints\Reward;

final readonly class ChannelPointsCustomRewardRedemptionUpdateEvent extends Event
{
    /**
     * @param string             $id                   The redemption identifier.
     * @param string             $broadcasterUserId    The requested broadcaster ID.
     * @param string             $broadcasterUserLogin The requested broadcaster login.
     * @param string             $broadcasterUserName  The requested broadcaster display name.
     * @param string             $userId               User ID of the user that redeemed the reward.
     * @param string             $userLogin            Login of the user that redeemed the reward.
     * @param string             $userName             Display name of the user that redeemed the reward.
     * @param string             $userInput            The user input provided. Empty string if not provided.
     * @param string             $status               Will be fulfilled or canceled. Possible values are unknown, unfulfilled, fulfilled,
     *                                                 and canceled.
     * @param Reward             $reward               Basic information about the reward that was redeemed, at the time it was redeemed.
     * @param \DateTimeImmutable $redeemedAt           RFC3339 timestamp of when the reward was redeemed.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $userInput,
        private string $status,
        private Reward $reward,
        private \DateTimeImmutable $redeemedAt
    ) {
    }

    public function getId(): string {
        return $this->id;
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

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserInput(): string {
        return $this->userInput;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getReward(): Reward {
        return $this->reward;
    }

    public function getRedeemedAt(): \DateTimeImmutable {
        return $this->redeemedAt;
    }
}
