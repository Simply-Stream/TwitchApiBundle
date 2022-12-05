<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class CharityCampaignDonation
{
    /**
     * An ID that identifies the charity campaign that the donation applies to.
     *
     * @var string
     */
    protected string $campaign_id;

    /**
     * An ID that identifies a user that donated money to the campaign.
     *
     * @var string
     */
    protected string $user_id;

    /**
     * The user’s login name.
     *
     * @var string
     */
    protected string $user_login;

    /**
     * The user’s display name.
     *
     * @var string
     */
    protected string $user_name;

    /**
     * An object that contains the amount of money that the user donated.
     *
     * @var array
     */
    protected array $amount;

    /**
     * @return string
     */
    public function getCampaignId(): string
    {
        return $this->campaign_id;
    }

    /**
     * @param string $campaign_id
     *
     * @return CharityCampaignDonation
     */
    public function setCampaignId(string $campaign_id): CharityCampaignDonation
    {
        $this->campaign_id = $campaign_id;

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
     * @return CharityCampaignDonation
     */
    public function setUserId(string $user_id): CharityCampaignDonation
    {
        $this->user_id = $user_id;

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
     * @return CharityCampaignDonation
     */
    public function setUserLogin(string $user_login): CharityCampaignDonation
    {
        $this->user_login = $user_login;

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
     * @return CharityCampaignDonation
     */
    public function setUserName(string $user_name): CharityCampaignDonation
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * @return array
     */
    public function getAmount(): array
    {
        return $this->amount;
    }

    /**
     * @param array $amount
     *
     * @return CharityCampaignDonation
     */
    public function setAmount(array $amount): CharityCampaignDonation
    {
        $this->amount = $amount;

        return $this;
    }
}
