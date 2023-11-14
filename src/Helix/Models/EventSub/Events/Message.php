<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Message
{
    use SerializesModels;

    /**
     * @param string  $text   The text of the resubscription chat message.
     * @param Emote[] $emotes An array that includes the emote ID and start and end positions for where the emote appears in the text.
     */
    public function __construct(
        private string $text,
        private array $emotes
    ) {
    }

    public function getText(): string {
        return $this->text;
    }

    public function getEmotes(): array {
        return $this->emotes;
    }
}
