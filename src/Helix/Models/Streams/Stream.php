<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Streams;

final readonly class Stream
{
    /**
     * @param string             $id           An ID that identifies the stream. You can use this ID later to look up the video on demand
     *                                         (VOD).
     * @param string             $userId       The ID of the user that’s broadcasting the stream.
     * @param string             $userLogin    The user’s login name.
     * @param string             $userName     The user’s display name.
     * @param string             $gameId       The ID of the category or game being played.
     * @param string             $gameName     The name of the category or game being played.
     * @param string             $type         The type of stream. Possible values are:
     *                                         - live
     *                                         If an error occurs, this field is set to an empty string.
     * @param string             $title        The stream’s title. Is an empty string if not set.
     * @param array              $tags         The tags applied to the stream.
     * @param int                $viewerCount  The number of users watching the stream.
     * @param \DateTimeImmutable $startedAt    The UTC date and time (in RFC3339 format) of when the broadcast began.
     * @param string             $language     The language that the stream uses. This is an ISO 639-1 two-letter language code or other if
     *                                         the stream uses a language not in the list of supported stream languages.
     * @param string             $thumbnailUrl A URL to an image of a frame from the last 5 minutes of the stream. Replace the width and
     *                                         height placeholders in the URL ({width}x{height}) with the size of the image you want, in
     *                                         pixels.
     * @param bool               $isMature     A Boolean value that indicates whether the stream is meant for mature audiences.
     */
    public function __construct(
        private string $id,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $gameId,
        private string $gameName,
        private string $type,
        private string $title,
        private array $tags,
        private int $viewerCount,
        private \DateTimeImmutable $startedAt,
        private string $language,
        private string $thumbnailUrl,
        private bool $isMature
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getGameId(): string {
        return $this->gameId;
    }

    public function getGameName(): string {
        return $this->gameName;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getTags(): array {
        return $this->tags;
    }

    public function getViewerCount(): int {
        return $this->viewerCount;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getLanguage(): string {
        return $this->language;
    }

    public function getThumbnailUrl(): string {
        return $this->thumbnailUrl;
    }

    public function isMature(): bool {
        return $this->isMature;
    }
}
