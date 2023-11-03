<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Chat;

final readonly class EmoteSet extends Emote
{
    /**
     * {@inheritDoc}
     *
     * @param string $emoteType   The type of emote. The possible values are:
     *                            - bitstier — A Bits tier emote.
     *                            - follower — A follower emote.
     *                            - subscriptions — A subscriber emote.
     * @param string $emoteSetId  An ID that identifies the emote set that the emote belongs to.
     * @param string $ownerId     The ID of the broadcaster who owns the emote.
     */
    public function __construct(
        string $id,
        string $name,
        Image $images,
        array $format,
        array $scale,
        array $themeMode,
        private string $emoteType,
        private string $emoteSetId,
        private string $ownerId,
    ) {
        parent::__construct($id, $name, $images, $format, $scale, $themeMode);
    }

    public function getEmoteType(): string {
        return $this->emoteType;
    }

    public function getEmoteSetId(): string {
        return $this->emoteSetId;
    }

    public function getOwnerId(): string {
        return $this->ownerId;
    }
}
