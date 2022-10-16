<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class TwitchUser
{
    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string 'partner', 'affiliate', or ''
     */
    protected string $broadcaster_type;

    /**
     * @var string
     */
    protected string $description;

    /**
     * @var string
     */
    protected string $display_name;

    /**
     * @var string
     */
    protected string $login;

    /**
     * @var string
     */
    protected string $offline_image_url;

    /**
     * @var ?string
     */
    protected ?string $profile_image_url = null;

    /**
     * @var string 'staff', 'admin', 'global_mod' or ''
     */
    protected string $type;

    /**
     * @var int
     * @deprecated For information, see Get Users API endpoint – “view_count” deprecation. The response continues to
     * include the field;
     * however, it contains stale data. You should stop displaying this data at your earliest convenience.
     */
    protected int $view_count;

    /**
     * @var string Returned if the request includes the user:read:email scope
     */
    protected string $email;

    /**
     * @var \DateTime
     */
    protected \DateTime $created_at;

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
     * @return TwitchUser
     */
    public function setId(string $id): TwitchUser
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterType(): string
    {
        return $this->broadcaster_type;
    }

    /**
     * @param string $broadcaster_type
     *
     * @return TwitchUser
     */
    public function setBroadcasterType(string $broadcaster_type): TwitchUser
    {
        $this->broadcaster_type = $broadcaster_type;

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
     * @return TwitchUser
     */
    public function setDescription(string $description): TwitchUser
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->display_name;
    }

    /**
     * @param string $display_name
     *
     * @return TwitchUser
     */
    public function setDisplayName(string $display_name): TwitchUser
    {
        $this->display_name = $display_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return TwitchUser
     */
    public function setLogin(string $login): TwitchUser
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getOfflineImageUrl(): string
    {
        return $this->offline_image_url;
    }

    /**
     * @param string $offline_image_url
     *
     * @return TwitchUser
     */
    public function setOfflineImageUrl(string $offline_image_url): TwitchUser
    {
        $this->offline_image_url = $offline_image_url;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getProfileImageUrl(): ?string
    {
        return $this->profile_image_url;
    }

    /**
     * @param string $profile_image_url
     *
     * @return TwitchUser
     */
    public function setProfileImageUrl(string $profile_image_url): TwitchUser
    {
        $this->profile_image_url = $profile_image_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return TwitchUser
     */
    public function setType(string $type): TwitchUser
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->view_count;
    }

    /**
     * @param int $view_count
     *
     * @return TwitchUser
     */
    public function setViewCount(int $view_count): TwitchUser
    {
        $this->view_count = $view_count;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return TwitchUser
     */
    public function setEmail(string $email): TwitchUser
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }

    /**
     * @param \DateTime $created_at
     *
     * @return TwitchUser
     */
    public function setCreatedAt(\DateTime $created_at): TwitchUser
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return 'https://twitch.tv/' . $this->getLogin();
    }
}
