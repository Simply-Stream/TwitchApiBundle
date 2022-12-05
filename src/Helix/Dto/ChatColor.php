<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ChatColor
{
    /**
     * An ID that uniquely identifies the user.
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
     * The Hex color code that the user uses in chat for their name. If the user hasn’t specified a color in their settings, the string is
     * empty.
     *
     * @var string
     */
    protected string $color;

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
     * @return ChatColor
     */
    public function setUserId(string $user_id): ChatColor
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
     * @return ChatColor
     */
    public function setUserLogin(string $user_login): ChatColor
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
     * @return ChatColor
     */
    public function setUserName(string $user_name): ChatColor
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return ChatColor
     */
    public function setColor(string $color): ChatColor
    {
        $this->color = $color;

        return $this;
    }
}
