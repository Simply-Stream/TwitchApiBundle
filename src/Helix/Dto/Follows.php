<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Follows
{
    /**
     * Date and time when the from_id user followed the to_id user.
     *
     * @var string
     */
    protected string $followed_at;

    /**
     * ID of the user following the to_id user.
     *
     * @var string
     */
    protected string $from_id;

    /**
     * Login of the user following the to_id user.
     *
     * @var string
     */
    protected string $from_login;

    /**
     * Display name corresponding to from_id.
     *
     * @var string
     */
    protected string $from_name;

    /**
     * ID of the user being followed by the from_id user.
     *
     * @var string
     */
    protected string $to_id;

    /**
     * Login of the user being followed by the from_id user.
     *
     * @var string
     */
    protected string $to_login;

    /**
     * Display name corresponding to to_id.
     *
     * @var string
     */
    protected string $to_name;

    /**
     * @return string
     */
    public function getFollowedAt(): string
    {
        return $this->followed_at;
    }

    /**
     * @param string $followed_at
     *
     * @return Follows
     */
    public function setFollowedAt(string $followed_at): Follows
    {
        $this->followed_at = $followed_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromId(): string
    {
        return $this->from_id;
    }

    /**
     * @param string $from_id
     *
     * @return Follows
     */
    public function setFromId(string $from_id): Follows
    {
        $this->from_id = $from_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromLogin(): string
    {
        return $this->from_login;
    }

    /**
     * @param string $from_login
     *
     * @return Follows
     */
    public function setFromLogin(string $from_login): Follows
    {
        $this->from_login = $from_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->from_name;
    }

    /**
     * @param string $from_name
     *
     * @return Follows
     */
    public function setFromName(string $from_name): Follows
    {
        $this->from_name = $from_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getToId(): string
    {
        return $this->to_id;
    }

    /**
     * @param string $to_id
     *
     * @return Follows
     */
    public function setToId(string $to_id): Follows
    {
        $this->to_id = $to_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getToLogin(): string
    {
        return $this->to_login;
    }

    /**
     * @param string $to_login
     *
     * @return Follows
     */
    public function setToLogin(string $to_login): Follows
    {
        $this->to_login = $to_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getToName(): string
    {
        return $this->to_name;
    }

    /**
     * @param string $to_name
     *
     * @return Follows
     */
    public function setToName(string $to_name): Follows
    {
        $this->to_name = $to_name;

        return $this;
    }
}
