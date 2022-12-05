<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class GameReport
{
    /**
     * An ID that identifies the game that the report was generated for.
     *
     * @var string
     */
    protected string $game_id;

    /**
     * The URL that you use to download the report. The URL is valid for 5 minutes.
     *
     * @var string
     */
    protected string $URL;

    /**
     * The type of report.
     *
     * @var string
     */
    protected string $type;

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
     * @return GameReport
     */
    public function setGameId(string $game_id): GameReport
    {
        $this->game_id = $game_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getURL(): string
    {
        return $this->URL;
    }

    /**
     * @param string $URL
     *
     * @return GameReport
     */
    public function setURL(string $URL): GameReport
    {
        $this->URL = $URL;

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
     * @return GameReport
     */
    public function setType(string $type): GameReport
    {
        $this->type = $type;

        return $this;
    }
}
