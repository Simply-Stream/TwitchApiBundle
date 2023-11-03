<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Chat;

final readonly class Version
{
    /**
     * @param string $id          An ID that identifies this version of the badge. The ID can be any value. For example, for Bits, the ID
     *                            is the Bits tier level, but for World of Warcraft, it could be Alliance or Horde.
     * @param string $imageUrl1x  A URL to the small version (18px x 18px) of the badge.
     * @param string $imageUrl2x  A URL to the medium version (36px x 36px) of the badge.
     * @param string $imageUrl4x  A URL to the large version (72px x 72px) of the badge.
     * @param string $title       The title of the badge.
     * @param string $description The description of the badge.
     * @param string $clickAction The action to take when clicking on the badge. Set to null if no action is specified.
     * @param string $clickUrl    The URL to navigate to when clicking on the badge. Set to null if no URL is specified.
     */
    public function __construct(
        private string $id,
        private string $imageUrl1x,
        private string $imageUrl2x,
        private string $imageUrl4x,
        private string $title,
        private string $description,
        private string $clickAction,
        private string $clickUrl,
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getImageUrl1x(): string {
        return $this->imageUrl1x;
    }

    public function getImageUrl2x(): string {
        return $this->imageUrl2x;
    }

    public function getImageUrl4x(): string {
        return $this->imageUrl4x;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getClickAction(): string {
        return $this->clickAction;
    }

    public function getClickUrl(): string {
        return $this->clickUrl;
    }
}
