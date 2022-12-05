<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Game
{
    /**
     * Template URL for a game’s box art.
     *
     * @var string
     */
    protected string $box_art_url;

    /**
     * Game ID.
     *
     * @var string
     */
    protected string $id;

    /**
     * Game name.
     *
     * @var string
     */
    protected string $name;

    /**
     * @return string
     */
    public function getBoxArtUrl(): string
    {
        return $this->box_art_url;
    }

    /**
     * @param string $box_art_url
     *
     * @return Game
     */
    public function setBoxArtUrl(string $box_art_url): Game
    {
        $this->box_art_url = $box_art_url;

        return $this;
    }

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
     * @return Game
     */
    public function setId(string $id): Game
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Game
     */
    public function setName(string $name): Game
    {
        $this->name = $name;

        return $this;
    }
}
