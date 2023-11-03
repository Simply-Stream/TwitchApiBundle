<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

final readonly class ExtensionLiveChannel
{
    /**
     * @param string $broadcasterId   The ID of the broadcaster that is streaming live and has installed or activated the extension.
     * @param string $broadcasterName The broadcaster’s display name.
     * @param string $gameName        The name of the category or game being streamed.
     * @param string $gameId          The ID of the category or game being streamed.
     * @param string $title           The title of the broadcaster’s stream. May be an empty string if not specified.
     */
    public function __construct(
        private string $broadcasterId,
        private string $broadcasterName,
        private string $gameName,
        private string $gameId,
        private string $title
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getGameName(): string {
        return $this->gameName;
    }

    public function getGameId(): string {
        return $this->gameId;
    }

    public function getTitle(): string {
        return $this->title;
    }
}
