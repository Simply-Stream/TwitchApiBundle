<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class CustomRewardRedemption
{
    /**
     * The list of redemptions for the specified reward. The list is empty if there are no redemptions that match the redemption criteria.
     *
     * @var array
     */
    protected array $data;

    /**
     * The ID that uniquely identifies the broadcaster.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * The broadcaster’s login name.
     *
     * @var string
     */
    protected string $broadcaster_login;

    /**
     * The broadcaster’s display name.
     *
     * @var string
     */
    protected string $broadcaster_name;

    /**
     * The ID that uniquely identifies this redemption.
     *
     * @var string
     */
    protected string $id;

    /**
     * The user’s login name.
     *
     * @var string
     */
    protected string $user_login;

    /**
     * The ID that uniquely identifies the user that redeemed the reward.
     *
     * @var string
     */
    protected string $user_id;

    /**
     * The user’s display name.
     *
     * @var string
     */
    protected string $user_name;

    /**
     * The text the user entered at the prompt when they redeemed the reward; otherwise, an empty string if user input was not required.
     *
     * @var string
     */
    protected string $user_input;

    /**
     * The state of the redemption. Possible values are:
     *
     * - CANCELED
     * - FULFILLED
     * - UNFULFILLED
     *
     * @var string
     */
    protected string $status;

    /**
     * The date and time of when the reward was redeemed, in RFC3339 format.
     *
     * @var \DateTime
     */
    protected \DateTime $redeemed_at;

    /**
     * The reward that the user redeemed.
     *
     * @var array
     */
    protected array $reward;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return CustomRewardRedemption
     */
    public function setData(array $data): CustomRewardRedemption
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterId(): string
    {
        return $this->broadcaster_id;
    }

    /**
     * @param string $broadcaster_id
     *
     * @return CustomRewardRedemption
     */
    public function setBroadcasterId(string $broadcaster_id): CustomRewardRedemption
    {
        $this->broadcaster_id = $broadcaster_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterLogin(): string
    {
        return $this->broadcaster_login;
    }

    /**
     * @param string $broadcaster_login
     *
     * @return CustomRewardRedemption
     */
    public function setBroadcasterLogin(string $broadcaster_login): CustomRewardRedemption
    {
        $this->broadcaster_login = $broadcaster_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterName(): string
    {
        return $this->broadcaster_name;
    }

    /**
     * @param string $broadcaster_name
     *
     * @return CustomRewardRedemption
     */
    public function setBroadcasterName(string $broadcaster_name): CustomRewardRedemption
    {
        $this->broadcaster_name = $broadcaster_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return CustomRewardRedemption
     */
    public function setId(string $id): CustomRewardRedemption
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserLogin(): string
    {
        return $this->user_login;
    }

    /**
     * @param string $user_login
     *
     * @return CustomRewardRedemption
     */
    public function setUserLogin(string $user_login): CustomRewardRedemption
    {
        $this->user_login = $user_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     *
     * @return CustomRewardRedemption
     */
    public function setUserId(string $user_id): CustomRewardRedemption
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     *
     * @return CustomRewardRedemption
     */
    public function setUserName(string $user_name): CustomRewardRedemption
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserInput(): string
    {
        return $this->user_input;
    }

    /**
     * @param string $user_input
     *
     * @return CustomRewardRedemption
     */
    public function setUserInput(string $user_input): CustomRewardRedemption
    {
        $this->user_input = $user_input;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return CustomRewardRedemption
     */
    public function setStatus(string $status): CustomRewardRedemption
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRedeemedAt(): \DateTime
    {
        return $this->redeemed_at;
    }

    /**
     * @param \DateTime $redeemed_at
     *
     * @return CustomRewardRedemption
     */
    public function setRedeemedAt(\DateTime $redeemed_at): CustomRewardRedemption
    {
        $this->redeemed_at = $redeemed_at;

        return $this;
    }

    /**
     * @return array
     */
    public function getReward(): array
    {
        return $this->reward;
    }

    /**
     * @param array $reward
     *
     * @return CustomRewardRedemption
     */
    public function setReward(array $reward): CustomRewardRedemption
    {
        $this->reward = $reward;

        return $this;
    }
}
