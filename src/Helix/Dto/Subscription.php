<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Subscription
{
    /**
     * User ID of the broadcaster.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * Login of the broadcaster.
     *
     * @var string
     */
    protected string $broadcaster_login;

    /**
     * Display name of the broadcaster.
     *
     * @var string
     */
    protected string $broadcaster_name;

    /**
     * If the subscription was gifted, this is the user ID of the gifter. Empty string otherwise.
     *
     * @var string
     */
    protected string $gifter_id;

    /**
     * If the subscription was gifted, this is the login of the gifter. Empty string otherwise.
     *
     * @var string
     */
    protected string $gifter_login;

    /**
     * If the subscription was gifted, this is the display name of the gifter. Empty string otherwise.
     *
     * @var string
     */
    protected string $gifter_name;

    /**
     * Is true if the subscription is a gift subscription.
     *
     * @var boolean
     */
    protected bool $is_gift;

    /**
     * Name of the subscription.
     *
     * @var string
     */
    protected string $plan_name;

    /**
     * Type of subscription (Tier 1, Tier 2, Tier 3).
     * 1000 = Tier 1, 2000 = Tier 2, 3000 = Tier 3 subscriptions.
     *
     * @var string
     */
    protected string $tier;

    /**
     * ID of the subscribed user.
     *
     * @var string
     */
    protected string $user_id;

    /**
     * Display name of the subscribed user.
     *
     * @var string
     */
    protected string $user_name;

    /**
     * Login of the subscribed user.
     *
     * @var string
     */
    protected string $user_login;

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
     * @return Subscription
     */
    public function setBroadcasterId(string $broadcaster_id): Subscription
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
     * @return Subscription
     */
    public function setBroadcasterLogin(string $broadcaster_login): Subscription
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
     * @return Subscription
     */
    public function setBroadcasterName(string $broadcaster_name): Subscription
    {
        $this->broadcaster_name = $broadcaster_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getGifterId(): string
    {
        return $this->gifter_id;
    }

    /**
     * @param string $gifter_id
     *
     * @return Subscription
     */
    public function setGifterId(string $gifter_id): Subscription
    {
        $this->gifter_id = $gifter_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getGifterLogin(): string
    {
        return $this->gifter_login;
    }

    /**
     * @param string $gifter_login
     *
     * @return Subscription
     */
    public function setGifterLogin(string $gifter_login): Subscription
    {
        $this->gifter_login = $gifter_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getGifterName(): string
    {
        return $this->gifter_name;
    }

    /**
     * @param string $gifter_name
     *
     * @return Subscription
     */
    public function setGifterName(string $gifter_name): Subscription
    {
        $this->gifter_name = $gifter_name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsGift(): bool
    {
        return $this->is_gift;
    }

    /**
     * @param bool $is_gift
     *
     * @return Subscription
     */
    public function setIsGift(bool $is_gift): Subscription
    {
        $this->is_gift = $is_gift;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlanName(): string
    {
        return $this->plan_name;
    }

    /**
     * @param string $plan_name
     *
     * @return Subscription
     */
    public function setPlanName(string $plan_name): Subscription
    {
        $this->plan_name = $plan_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getTier(): string
    {
        return $this->tier;
    }

    /**
     * @param string $tier
     *
     * @return Subscription
     */
    public function setTier(string $tier): Subscription
    {
        $this->tier = $tier;

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
     * @return Subscription
     */
    public function setUserId(string $user_id): Subscription
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
     * @return Subscription
     */
    public function setUserName(string $user_name): Subscription
    {
        $this->user_name = $user_name;

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
     * @return Subscription
     */
    public function setUserLogin(string $user_login): Subscription
    {
        $this->user_login = $user_login;

        return $this;
    }
}
