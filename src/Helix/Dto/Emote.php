<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Emote
{
    /**
     * An ID that identifies this emote.
     *
     * @var string
     */
    protected string $id;
    /**
     * The name of the emote. This is the name that viewers type in the chat window to get the emote to appear.
     *
     * @var string
     */
    protected string $name;
    /**
     * The image URLs for the emote. These image URLs always provide a static, non-animated emote image with a light background.
     *
     * NOTE: You should use the templated URL in the template field to fetch the image instead of using these URLs.
     *
     * @var array
     */
    protected array $images;

    /**
     * The subscriber tier at which the emote is unlocked. This field contains the tier information only if emote_type is set to
     * subscriptions, otherwise, it’s an empty string.
     *
     * @var string
     */
    protected string $tier;

    /**
     * The type of emote. The possible values are:
     * - bitstier — A custom Bits tier emote.
     * - follower — A custom follower emote.
     * - subscriptions — A custom subscriber emote.
     *
     * @var string
     */
    protected string $emote_type;

    /**
     * An ID that identifies the emote set that the emote belongs to.
     *
     * @var string
     */
    protected string $emote_set_id;

    /**
     * The formats that the emote is available in. For example, if the emote is available only as a static PNG, the array contains only
     * static. But if the emote is available as a static PNG and an animated GIF, the array contains static and animated. The possible
     * formats are:
     * - animated — An animated GIF is available for this emote.
     * - static — A static PNG file is available for this emote.
     *
     * @var array<string>
     */
    protected array $format;

    /**
     * The sizes that the emote is available in. For example, if the emote is available in small and medium sizes, the array contains 1.0
     * and
     * 2.0. Possible sizes are:
     * - 1.0 — A small version (28px x 28px) is available.
     * - 2.0 — A medium version (56px x 56px) is available.
     * - 3.0 — A large version (112px x 112px) is available.
     *
     * @var array<string>
     */
    protected array $scale;

    /**
     * The background themes that the emote is available in. Possible themes are:
     * - dark
     * - light
     *
     * @var array<string>
     */
    protected array $theme_mode;

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
     * @return Emote
     */
    public function setId(string $id): Emote
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
     * @return Emote
     */
    public function setName(string $name): Emote
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     *
     * @return Emote
     */
    public function setImages(array $images): Emote
    {
        $this->images = $images;

        return $this;
    }

    /**
     * @return string
     */
    public function getTier(): string
    {
        return $this->tier;
    }

    /**
     * @param string $tier
     *
     * @return Emote
     */
    public function setTier(string $tier): Emote
    {
        $this->tier = $tier;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmoteType(): string
    {
        return $this->emote_type;
    }

    /**
     * @param string $emote_type
     *
     * @return Emote
     */
    public function setEmoteType(string $emote_type): Emote
    {
        $this->emote_type = $emote_type;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmoteSetId(): string
    {
        return $this->emote_set_id;
    }

    /**
     * @param string $emote_set_id
     *
     * @return Emote
     */
    public function setEmoteSetId(string $emote_set_id): Emote
    {
        $this->emote_set_id = $emote_set_id;

        return $this;
    }

    /**
     * @return array
     */
    public function getFormat(): array
    {
        return $this->format;
    }

    /**
     * @param array $format
     *
     * @return Emote
     */
    public function setFormat(array $format): Emote
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @return array
     */
    public function getScale(): array
    {
        return $this->scale;
    }

    /**
     * @param array $scale
     *
     * @return Emote
     */
    public function setScale(array $scale): Emote
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * @return array
     */
    public function getThemeMode(): array
    {
        return $this->theme_mode;
    }

    /**
     * @param array $theme_mode
     *
     * @return Emote
     */
    public function setThemeMode(array $theme_mode): Emote
    {
        $this->theme_mode = $theme_mode;

        return $this;
    }
}
