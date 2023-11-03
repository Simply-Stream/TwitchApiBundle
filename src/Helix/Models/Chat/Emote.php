<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Chat;

readonly class Emote
{
    /**
     * @param string   $id          An ID that identifies this emote.
     * @param string   $name        The name of the emote. This is the name that viewers type in the chat window to get the emote to appear.
     * @param Image    $images      The image URLs for the emote. These image URLs always provide a static, non-animated emote image with a
     *                              light background. NOTE: You should use the templated URL in the template field to fetch the image
     *                              instead of using these URLs.
     * @param string[] $format      The formats that the emote is available in. For example, if the emote is available only as a static PNG,
     *                              the array contains only static. But if the emote is available as a static PNG and an animated GIF, the
     *                              array contains static and animated. The possible formats are:
     *                              - animated — An animated GIF is available for this emote.
     *                              - static — A static PNG file is available for this emote.
     * @param string[] $scale       The sizes that the emote is available in. For example, if the emote is available in small and medium
     *                              sizes, the array contains 1.0 and 2.0. Possible sizes are:
     *                              - 1.0 — A small version (28px x 28px) is available.
     *                              - 2.0 — A medium version (56px x 56px) is available.
     *                              - 3.0 — A large version (112px x 112px) is available.
     * @param string[] $themeMode   The background themes that the emote is available in. Possible themes are:
     *                              - dark
     *                              - light
     */
    public function __construct(
        private string $id,
        private string $name,
        private Image $images,
        private array $format,
        private array $scale,
        private array $themeMode
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getImages(): Image {
        return $this->images;
    }

    public function getFormat(): array {
        return $this->format;
    }

    public function getScale(): array {
        return $this->scale;
    }

    public function getThemeMode(): array {
        return $this->themeMode;
    }
}
