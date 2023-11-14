<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Videos;

final readonly class Video
{
    /**
     * @param string             $id            An ID that identifies the video.
     * @param string             $streamId      The ID of the stream that the video originated from if the video’s type is “archive;”
     *                                          otherwise, null.
     * @param string             $userId        The ID of the broadcaster that owns the video.
     * @param string             $userLogin     The broadcaster’s login name.
     * @param string             $userName      The broadcaster’s display name.
     * @param string             $title         The video’s title.
     * @param string             $description   The video’s description.
     * @param \DateTimeImmutable $createdAt     The date and time, in UTC, of when the video was created. The timestamp is in RFC3339
     *                                          format.
     * @param \DateTimeImmutable $publishedAt   The date and time, in UTC, of when the video was published. The timestamp is in RFC3339
     *                                          format.
     * @param string             $url           The video’s URL.
     * @param string             $thumbnailUrl  A URL to a thumbnail image of the video. Before using the URL, you must replace the
     *                                          %{width}
     *                                          and %{height} placeholders with the width and height of the thumbnail you want returned.
     *                                          Specify the width and height in pixels. Because the CDN preserves the thumbnail’s ratio,
     *                                          the
     *                                          thumbnail may not be the exact size you requested.
     * @param string             $viewable      The video’s viewable state. Always set to public.
     * @param int                $viewCount     The number of times that users have watched the video.
     * @param string             $language      The ISO 639-1 two-letter language code that the video was broadcast in. For example, the
     *                                          language code is DE if the video was broadcast in German. For a list of supported
     *                                          languages,
     *                                          see Supported Stream Language. The language value is “other” if the video was broadcast in
     *                                          a
     *                                          language not in the list of supported languages.
     * @param string             $type          The video’s type. Possible values are:
     *                                          - archive — An on-demand video (VOD) of one of the broadcaster's past streams.
     *                                          - highlight — A highlight reel of one of the broadcaster's past streams. See Creating
     *                                          Highlights.
     *                                          - upload — A video that the broadcaster uploaded to their video library. See Upload under
     *                                          Video Producer.
     * @param string             $duration      The video’s length in ISO 8601 duration format. For example, 3m21s represents 3 minutes, 21
     *                                          seconds.
     * @param array              $mutedSegments The segments that Twitch Audio Recognition muted; otherwise, null.
     */
    public function __construct(
        private string $id,
        private string $streamId,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $title,
        private string $description,
        private \DateTimeImmutable $createdAt,
        private \DateTimeImmutable $publishedAt,
        private string $url,
        private string $thumbnailUrl,
        private string $viewable,
        private int $viewCount,
        private string $language,
        private string $type,
        private string $duration,
        private array $mutedSegments
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getStreamId(): string {
        return $this->streamId;
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

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getPublishedAt(): \DateTimeImmutable {
        return $this->publishedAt;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getThumbnailUrl(): string {
        return $this->thumbnailUrl;
    }

    public function getViewable(): string {
        return $this->viewable;
    }

    public function getViewCount(): int {
        return $this->viewCount;
    }

    public function getLanguage(): string {
        return $this->language;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getDuration(): string {
        return $this->duration;
    }

    public function getMutedSegments(): array {
        return $this->mutedSegments;
    }
}
