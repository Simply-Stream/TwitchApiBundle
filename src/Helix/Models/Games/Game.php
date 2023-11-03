<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Games;

final readonly class Game
{
    /**
     * @param string $id        An ID that identifies the category or game.
     * @param string $name      The category’s or game’s name.
     * @param string $boxArtUrl A URL to the category’s or game’s box art. You must replace the {width}x{height} placeholder with the size
     *                          of image you want.
     * @param string $igdbId    The ID that IGDB uses to identify this game. If the IGDB ID is not available to Twitch, this field is set
     *                          to an empty string.
     */
    public function __construct(
        private string $id,
        private string $name,
        private string $boxArtUrl,
        private string $igdbId
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getBoxArtUrl(): string {
        return $this->boxArtUrl;
    }

    public function getIgdbId(): string {
        return $this->igdbId;
    }
}
