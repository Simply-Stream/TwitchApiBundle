<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Message
{
    use SerializesModels;

    /**
     * @param string            $text      The chat message in plain text.
     * @param MessageFragment[] $fragments Ordered list of chat message fragments.
     */
    public function __construct(
        private string $text,
        private array $fragments
    ) {
    }

    public function getText(): string {
        return $this->text;
    }

    public function getFragments(): array {
        return $this->fragments;
    }
}
