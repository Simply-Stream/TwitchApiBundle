<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ChatBadge
{
    /**
     * @var string An ID that identifies this version of the badge. The ID can be any value. For example, for Bits, the ID is the
     * Bits tier level, but for World of Warcraft, it could be Alliance or Horde.
     */
    protected string $id;

    /**
     * @var string A URL to the small version (18px x 18px) of the badge.
     */
    protected string $image_url_1x;

    /**
     * @var string A URL to the medium version (36px x 36px) of the badge.
     */
    protected string $image_url_2x;

    /**
     * @var string A URL to the large version (72px x 72px) of the badge.
     */
    protected string $image_url_4x;

    /**
     * @var string The title of the badge.
     */
    protected string $title;

    /**
     * @var string The description of the badge.
     */
    protected string $description;

    /**
     * @var string|null The action to take when clicking on the badge. Set to null if no action is specified.
     */
    protected ?string $click_action = null;

    /**
     * @var string|null The URL to navigate to when clicking on the badge. Set to null if no URL is specified.
     */
    protected ?string $click_url = null;

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
     * @return ChatBadge
     */
    public function setId(string $id): ChatBadge
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl1x(): string
    {
        return $this->image_url_1x;
    }

    /**
     * @param string $image_url_1x
     *
     * @return ChatBadge
     */
    public function setImageUrl1x(string $image_url_1x): ChatBadge
    {
        $this->image_url_1x = $image_url_1x;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl2x(): string
    {
        return $this->image_url_2x;
    }

    /**
     * @param string $image_url_2x
     *
     * @return ChatBadge
     */
    public function setImageUrl2x(string $image_url_2x): ChatBadge
    {
        $this->image_url_2x = $image_url_2x;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl4x(): string
    {
        return $this->image_url_4x;
    }

    /**
     * @param string $image_url_4x
     *
     * @return ChatBadge
     */
    public function setImageUrl4x(string $image_url_4x): ChatBadge
    {
        $this->image_url_4x = $image_url_4x;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return ChatBadge
     */
    public function setTitle(string $title): ChatBadge
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return ChatBadge
     */
    public function setDescription(string $description): ChatBadge
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getClickAction(): string
    {
        return $this->click_action;
    }

    /**
     * @param string $click_action
     *
     * @return ChatBadge
     */
    public function setClickAction(string $click_action): ChatBadge
    {
        $this->click_action = $click_action;

        return $this;
    }

    /**
     * @return string
     */
    public function getClickUrl(): string
    {
        return $this->click_url;
    }

    /**
     * @param string $click_url
     *
     * @return ChatBadge
     */
    public function setClickUrl(string $click_url): ChatBadge
    {
        $this->click_url = $click_url;

        return $this;
    }
}
