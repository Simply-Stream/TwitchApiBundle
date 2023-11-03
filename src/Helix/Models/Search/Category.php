<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Search;

final readonly class Category
{
    /**
     * @param string $id        An ID that uniquely identifies the game or category.
     * @param string $name      The name of the game or category.
     * @param string $boxArtUrl A URL to an image of the game’s box art or streaming category.
     */
    public function __construct(
        private string $id,
        private string $name,
        private string $boxArtUrl,
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
}
