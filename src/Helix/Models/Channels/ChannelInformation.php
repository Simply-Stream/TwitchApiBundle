<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Channels;

final readonly class ChannelInformation
{
    /**
     * @param string   $broadcasterId               An ID that uniquely identifies the broadcaster.
     * @param string   $broadcasterLogin            The broadcaster’s login name.
     * @param string   $broadcasterName             The broadcaster’s display name.
     * @param string   $broadcasterLanguage         The broadcaster’s preferred language. The value is an ISO 639-1 two-letter language
     *                                              code (for example, en for English). The value is set to “other” if the language is not
     *                                              a Twitch supported language.
     * @param string   $gameName                    The name of the game that the broadcaster is playing or last played. The value is an
     *                                              empty string if the broadcaster has never played a game.
     * @param string   $gameId                      An ID that uniquely identifies the game that the broadcaster is playing or last played.
     *                                              The value is an empty string if the broadcaster has never played a game.
     * @param string   $title                       The title of the stream that the broadcaster is currently streaming or last streamed.
     *                                              The value is an empty string if the broadcaster has never streamed.
     * @param int      $delay                       The value of the broadcaster’s stream delay setting, in seconds. This field’s value
     *                                              defaults to zero unless 1) the request specifies a user access token, 2) the ID in the
     *                                              broadcaster_id query parameter matches the user ID in the access token, and 3) the
     *                                              broadcaster has partner status and they set a non-zero stream delay value.
     * @param string[] $tags                        The tags applied to the channel.
     * @param string[] $contentClassificationLabels The CCLs applied to the channel.
     * @param bool     $isBrandedContent            Boolean flag indicating if the channel has branded content.
     */
    public function __construct(
        private string $broadcasterId,
        private string $broadcasterLogin,
        private string $broadcasterName,
        private string $broadcasterLanguage,
        private string $gameName,
        private string $gameId,
        private string $title,
        private int $delay,
        private array $tags,
        private array $contentClassificationLabels,
        private bool $isBrandedContent
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getBroadcasterLanguage(): string {
        return $this->broadcasterLanguage;
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

    public function getDelay(): int {
        return $this->delay;
    }

    public function getTags(): array {
        return $this->tags;
    }

    public function getContentClassificationLabels(): array {
        return $this->contentClassificationLabels;
    }

    public function isBrandedContent(): bool {
        return $this->isBrandedContent;
    }
}
