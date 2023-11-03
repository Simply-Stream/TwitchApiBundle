<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Chat;

final readonly class ChannelEmote extends Emote
{
    /**
     * {@inheritDoc}
     *
     * @param string $tier         The subscriber tier at which the emote is unlocked. This field contains the tier information only if
     *                             emote_type is set to subscriptions, otherwise, it’s an empty string.
     * @param string $emoteType    The type of emote. The possible values are:
     *                             - bitstier — A custom Bits tier emote.
     *                             - follower — A custom follower emote.
     *                             - subscriptions — A custom subscriber emote.
     * @param string $emoteSetId   An ID that identifies the emote set that the emote belongs to.
     */
    public function __construct(
        string $id,
        string $name,
        Image $images,
        array $format,
        array $scale,
        array $themeMode,
        private string $tier,
        private string $emoteType,
        private string $emoteSetId,
    ) {
        parent::__construct($id, $name, $images, $format, $scale, $themeMode);
    }

    public function getTier(): string {
        return $this->tier;
    }

    public function getEmoteType(): string {
        return $this->emoteType;
    }

    public function getEmoteSetId(): string {
        return $this->emoteSetId;
    }
}
