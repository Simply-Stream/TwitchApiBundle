<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ChannelEditor
{
    /**
     * An ID that uniquely identifies a user with editor permissions.
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
     * The date and time, in RFC3339 format, when the user became one of the broadcaster’s editors.
     *
     * @var string
     */
    protected string $created_at;

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
     * @return ChannelEditor
     */
    public function setUserId(string $user_id): ChannelEditor
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
     * @return ChannelEditor
     */
    public function setUserName(string $user_name): ChannelEditor
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     *
     * @return ChannelEditor
     */
    public function setCreatedAt(string $created_at): ChannelEditor
    {
        $this->created_at = $created_at;

        return $this;
    }
}
