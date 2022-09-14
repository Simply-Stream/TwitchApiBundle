<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ChannelInformation
{
    /**
     * Twitch User ID of this channel owner.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * Broadcaster’s user login name.
     *
     * @var string
     */
    protected string $broadcaster_login;

    /**
     * Twitch user display name of this channel owner.
     *
     * @var string
     */
    protected string $broadcaster_name;

    /**
     * Name of the game being played on the channel.
     *
     * @var string
     */
    protected string $game_name;

    /**
     * Current game ID being played on the channel.
     *
     * @var string
     */
    protected string $game_id;

    /**
     * Language of the channel. A language value is either the ISO 639-1 two-letter code for a supported stream language or “other”.
     *
     * @var string
     */
    protected string $broadcaster_language;

    /**
     * Title of the stream.
     *
     * @var string
     */
    protected string $title;

    /**
     * Stream delay in seconds.
     *
     * @var int
     */
    protected int $delay;

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
     * @return ChannelInformation
     */
    public function setBroadcasterId(string $broadcaster_id): ChannelInformation
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
     * @return ChannelInformation
     */
    public function setBroadcasterLogin(string $broadcaster_login): ChannelInformation
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
     * @return ChannelInformation
     */
    public function setBroadcasterName(string $broadcaster_name): ChannelInformation
    {
        $this->broadcaster_name = $broadcaster_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getGameName(): string
    {
        return $this->game_name;
    }

    /**
     * @param string $game_name
     *
     * @return ChannelInformation
     */
    public function setGameName(string $game_name): ChannelInformation
    {
        $this->game_name = $game_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getGameId(): string
    {
        return $this->game_id;
    }

    /**
     * @param string $game_id
     *
     * @return ChannelInformation
     */
    public function setGameId(string $game_id): ChannelInformation
    {
        $this->game_id = $game_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterLanguage(): string
    {
        return $this->broadcaster_language;
    }

    /**
     * @param string $broadcaster_language
     *
     * @return ChannelInformation
     */
    public function setBroadcasterLanguage(string $broadcaster_language): ChannelInformation
    {
        $this->broadcaster_language = $broadcaster_language;

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
     * @return ChannelInformation
     */
    public function setTitle(string $title): ChannelInformation
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getDelay(): int
    {
        return $this->delay;
    }

    /**
     * @param int $delay
     *
     * @return ChannelInformation
     */
    public function setDelay(int $delay): ChannelInformation
    {
        $this->delay = $delay;

        return $this;
    }
}
