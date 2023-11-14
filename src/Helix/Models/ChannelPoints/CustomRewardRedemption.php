<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\ChannelPoints;

final readonly class CustomRewardRedemption
{
    /**
     * @param string             $broadcasterId    The ID that uniquely identifies the broadcaster.
     * @param string             $broadcasterLogin The broadcaster’s login name.
     * @param string             $broadcasterName  The broadcaster’s display name.
     * @param string             $id               The ID that uniquely identifies this redemption.
     * @param string             $userId           The user’s login name.
     * @param string             $userLogin        The ID that uniquely identifies the user that redeemed the reward.
     * @param string             $userName         The user’s display name.
     * @param string             $userInput        The text the user entered at the prompt when they redeemed the reward; otherwise, an
     *                                             empty string if user input was not required.
     * @param string             $status           The state of the redemption. Possible values are:
     *                                             - CANCELED
     *                                             - FULFILLED
     *                                             - UNFULFILLED
     * @param \DateTimeImmutable $redeemedAt       The date and time of when the reward was redeemed, in RFC3339 format.
     * @param Reward             $reward           The reward that the user redeemed.
     */
    public function __construct(
        private string $broadcasterId,
        private string $broadcasterLogin,
        private string $broadcasterName,
        private string $id,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $userInput,
        private string $status,
        private \DateTimeImmutable $redeemedAt,
        private Reward $reward
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getId(): string {
        return $this->id;
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

    public function getRedeemedAt(): \DateTimeImmutable {
        return $this->redeemedAt;
    }

    public function getReward(): Reward {
        return $this->reward;
    }
}
