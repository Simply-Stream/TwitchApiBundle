<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Clip;

final readonly class    Clip
{
    /**
     * @param string             $id              An ID that uniquely identifies the clip.
     * @param string             $url             A URL to the clip.
     * @param string             $embedUrl        A URL that you can use in an iframe to embed the clip
     * @param string             $broadcasterId   An ID that identifies the broadcaster that the video was clipped from.
     * @param string             $broadcasterName The broadcaster’s display name.
     * @param string             $creatorId       An ID that identifies the user that created the clip.
     * @param string             $creatorName     The user’s display name.
     * @param string             $videoId         An ID that identifies the video that the clip came from. This field contains an empty
     *                                            string if the video is not available.
     * @param string             $gameId          The ID of the game that was being played when the clip was created.
     * @param string             $language        The ISO 639-1 two-letter language code that the broadcaster broadcasts in. For example,
     *                                            en for English. The value is other if the broadcaster uses a language that Twitch doesn’t
     *                                            support.
     * @param string             $title           The title of the clip.
     * @param int                $viewCount       The number of times the clip has been viewed.
     * @param \DateTimeImmutable $createdAt       The date and time of when the clip was created. The date and time is in RFC3339 format.
     * @param string             $thumbnailUrl    A URL to a thumbnail image of the clip.
     * @param float              $duration        The length of the clip, in seconds. Precision is 0.1.
     * @param int                $vodOffset       The zero-based offset, in seconds, to where the clip starts in the video (VOD). Is null
     *                                            if the video is not available or hasn’t been created yet from the live stream (see
     *                                            video_id).
     *
     *                                            Note that there’s a delay between when a clip is created during a broadcast and when the
     *                                            offset is set. During the delay period, vod_offset is null. The delay is indeterminant
     *                                            but is typically minutes long.
     * @param bool               $isFeatured      A Boolean value that indicates if the clip is featured or not.
     */
    public function __construct(
        private string $id,
        private string $url,
        private string $embedUrl,
        private string $broadcasterId,
        private string $broadcasterName,
        private string $creatorId,
        private string $creatorName,
        private string $videoId,
        private string $gameId,
        private string $language,
        private string $title,
        private int $viewCount,
        private \DateTimeImmutable $createdAt,
        private string $thumbnailUrl,
        private float $duration,
        private int $vodOffset,
        private bool $isFeatured
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getEmbedUrl(): string {
        return $this->embedUrl;
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getCreatorId(): string {
        return $this->creatorId;
    }

    public function getCreatorName(): string {
        return $this->creatorName;
    }

    public function getVideoId(): string {
        return $this->videoId;
    }

    public function getGameId(): string {
        return $this->gameId;
    }

    public function getLanguage(): string {
        return $this->language;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getViewCount(): int {
        return $this->viewCount;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getThumbnailUrl(): string {
        return $this->thumbnailUrl;
    }

    public function getDuration(): float {
        return $this->duration;
    }

    public function getVodOffset(): int {
        return $this->vodOffset;
    }

    public function isFeatured(): bool {
        return $this->isFeatured;
    }
}
