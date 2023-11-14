<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Emote
{
    use SerializesModels;

    /**
     * @param string   $id         An ID that uniquely identifies this emote.
     * @param string   $emoteSetId An ID that identifies the emote set that the emote belongs to.
     * @param string   $ownerId    The ID of the broadcaster who owns the emote.
     * @param string[] $format     The formats that the emote is available in. For example, if the emote is available only as a static PNG,
     *                             the array contains only static. But if the emote is available as a static PNG and an animated GIF, the
     *                             array contains static and animated. The possible formats are:
     *                             - animated — An animated GIF is available for this emote.
     *                             - static — A static PNG file is available for this emote.
     */
    public function __construct(
        private string $id,
        private string $emoteSetId,
        private string $ownerId,
        private array $format
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getEmoteSetId(): string {
        return $this->emoteSetId;
    }

    public function getOwnerId(): string {
        return $this->ownerId;
    }

    public function getFormat(): array {
        return $this->format;
    }
}
