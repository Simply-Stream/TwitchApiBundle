<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Chatter
{
    /**
     * The ID of a user that’s connected to the broadcaster’s chat room.
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
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     *
     * @return Chatter
     */
    public function setUserId(string $user_id): Chatter
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
     * @return Chatter
     */
    public function setUserLogin(string $user_login): Chatter
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
     * @return Chatter
     */
    public function setUserName(string $user_name): Chatter
    {
        $this->user_name = $user_name;

        return $this;
    }
}
