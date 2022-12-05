<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class CharityCampaign
{
    /**
     * An ID that uniquely identifies the charity campaign.
     *
     * @var string
     */
    protected string $id;

    /**
     * An ID that uniquely identifies the broadcaster that’s running the campaign.
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
     * The charity’s name.
     *
     * @var string
     */
    protected string $charity_name;

    /**
     * A description of the charity.
     *
     * @var string
     */
    protected string $charity_description;

    /**
     * A URL to an image of the charity’s logo. The image’s type is PNG and its size is 100px X 100px.
     *
     * @var string
     */
    protected string $charity_logo;

    /**
     * A URL to the charity’s website.
     *
     * @var string
     */
    protected string $charity_website;

    /**
     * The current amount of donations that the campaign has received.
     *
     * @var array
     */
    protected array $current_amount;

    /**
     * The campaign’s fundraising goal. This field is null if the broadcaster has not defined a fundraising goal.
     *
     * @var array
     */
    protected array $target_amount;

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
     * @return CharityCampaign
     */
    public function setId(string $id): CharityCampaign
    {
        $this->id = $id;

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
     * @return CharityCampaign
     */
    public function setBroadcasterId(string $broadcaster_id): CharityCampaign
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
     * @return CharityCampaign
     */
    public function setBroadcasterLogin(string $broadcaster_login): CharityCampaign
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
     * @return CharityCampaign
     */
    public function setBroadcasterName(string $broadcaster_name): CharityCampaign
    {
        $this->broadcaster_name = $broadcaster_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharityName(): string
    {
        return $this->charity_name;
    }

    /**
     * @param string $charity_name
     *
     * @return CharityCampaign
     */
    public function setCharityName(string $charity_name): CharityCampaign
    {
        $this->charity_name = $charity_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharityDescription(): string
    {
        return $this->charity_description;
    }

    /**
     * @param string $charity_description
     *
     * @return CharityCampaign
     */
    public function setCharityDescription(string $charity_description): CharityCampaign
    {
        $this->charity_description = $charity_description;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharityLogo(): string
    {
        return $this->charity_logo;
    }

    /**
     * @param string $charity_logo
     *
     * @return CharityCampaign
     */
    public function setCharityLogo(string $charity_logo): CharityCampaign
    {
        $this->charity_logo = $charity_logo;

        return $this;
    }

    /**
     * @return string
     */
    public function getCharityWebsite(): string
    {
        return $this->charity_website;
    }

    /**
     * @param string $charity_website
     *
     * @return CharityCampaign
     */
    public function setCharityWebsite(string $charity_website): CharityCampaign
    {
        $this->charity_website = $charity_website;

        return $this;
    }

    /**
     * @return array
     */
    public function getCurrentAmount(): array
    {
        return $this->current_amount;
    }

    /**
     * @param array $current_amount
     *
     * @return CharityCampaign
     */
    public function setCurrentAmount(array $current_amount): CharityCampaign
    {
        $this->current_amount = $current_amount;

        return $this;
    }

    /**
     * @return array
     */
    public function getTargetAmount(): array
    {
        return $this->target_amount;
    }

    /**
     * @param array $target_amount
     *
     * @return CharityCampaign
     */
    public function setTargetAmount(array $target_amount): CharityCampaign
    {
        $this->target_amount = $target_amount;

        return $this;
    }
}
