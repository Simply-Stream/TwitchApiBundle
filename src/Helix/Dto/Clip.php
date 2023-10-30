<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Clip
{
    /**
     * ID of the clip being queried.
     *
     * @var string
     */
    protected string $id;

    /**
     * URL where the clip can be viewed.
     *
     * @var string
     */
    protected string $url;

    /**
     * URL to embed the clip.
     *
     * @var string
     */
    protected string $embed_url;

    /**
     * User ID of the stream from which the clip was created.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * Display name corresponding to broadcaster_id.
     *
     * @var string
     */
    protected string $broadcaster_name;

    /**
     * ID of the user who created the clip.
     *
     * @var string
     */
    protected string $creator_id;

    /**
     * Display name corresponding to creator_id.
     *
     * @var string
     */
    protected string $creator_name;

    /**
     * ID of the video from which the clip was created. This field contains an empty string if the video is not available.
     *
     * @var string
     */
    protected string $video_id;

    /**
     * ID of the game assigned to the stream when the clip was created.
     *
     * @var string
     */
    protected string $game_id;

    /**
     * Language of the stream from which the clip was created.
     * A language value is either the ISO 639-1 two-letter code for a supported stream language or “other”.
     *
     * @var string
     */
    protected string $language;

    /**
     * Title of the clip.
     *
     * @var string
     */
    protected string $title;

    /**
     * Number of times the clip has been viewed.
     *
     * @var int
     */
    protected int $view_count;

    /**
     * Date when the clip was created.
     *
     * @var string
     */
    protected string $created_at;

    /**
     * URL of the clip thumbnail.
     *
     * @var string
     */
    protected string $thumbnail_url;

    /**
     * Duration of the Clip in seconds (up to 0.1 precision).
     *
     * @var float
     */
    protected float $duration;

    /**
     * The zero-based offset, in seconds, to where the clip starts in the video (VOD).
     * Is null if the video is not available or hasn’t been created yet from the live stream. See video_id.
     *
     * Note that there’s a delay between when a clip is created during a broadcast and when the offset is set.
     * During the delay period, vod_offset is null. The delay is indeterminant but is typically minutes long.
     *
     * @var ?int
     */
    protected ?int $vod_offset;

    /**
     * A Boolean value that indicates if the clip is featured or not.
     *
     * @var bool
     */
    protected bool $is_featured;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Clip
     */
    public function setId(string $id): Clip
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return Clip
     */
    public function setUrl(string $url): Clip
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmbedUrl(): string
    {
        return $this->embed_url;
    }

    /**
     * @param string $embed_url
     *
     * @return Clip
     */
    public function setEmbedUrl(string $embed_url): Clip
    {
        $this->embed_url = $embed_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterId(): string
    {
        return $this->broadcaster_id;
    }

    /**
     * @param string $broadcaster_id
     *
     * @return Clip
     */
    public function setBroadcasterId(string $broadcaster_id): Clip
    {
        $this->broadcaster_id = $broadcaster_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterName(): string
    {
        return $this->broadcaster_name;
    }

    /**
     * @param string $broadcaster_name
     *
     * @return Clip
     */
    public function setBroadcasterName(string $broadcaster_name): Clip
    {
        $this->broadcaster_name = $broadcaster_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatorId(): string
    {
        return $this->creator_id;
    }

    /**
     * @param string $creator_id
     *
     * @return Clip
     */
    public function setCreatorId(string $creator_id): Clip
    {
        $this->creator_id = $creator_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatorName(): string
    {
        return $this->creator_name;
    }

    /**
     * @param string $creator_name
     *
     * @return Clip
     */
    public function setCreatorName(string $creator_name): Clip
    {
        $this->creator_name = $creator_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->video_id;
    }

    /**
     * @param string $video_id
     *
     * @return Clip
     */
    public function setVideoId(string $video_id): Clip
    {
        $this->video_id = $video_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getGameId(): string
    {
        return $this->game_id;
    }

    /**
     * @param string $game_id
     *
     * @return Clip
     */
    public function setGameId(string $game_id): Clip
    {
        $this->game_id = $game_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return Clip
     */
    public function setLanguage(string $language): Clip
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Clip
     */
    public function setTitle(string $title): Clip
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewCount(): int
    {
        return $this->view_count;
    }

    /**
     * @param int $view_count
     *
     * @return Clip
     */
    public function setViewCount(int $view_count): Clip
    {
        $this->view_count = $view_count;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     *
     * @return Clip
     */
    public function setCreatedAt(string $created_at): Clip
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnail_url;
    }

    /**
     * @param string $thumbnail_url
     *
     * @return Clip
     */
    public function setThumbnailUrl(string $thumbnail_url): Clip
    {
        $this->thumbnail_url = $thumbnail_url;

        return $this;
    }

    /**
     * @return float
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * @param float $duration
     *
     * @return Clip
     */
    public function setDuration(float $duration): Clip
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return ?int
     */
    public function getVodOffset(): ?int
    {
        return $this->vod_offset;
    }

    /**
     * @param ?int $vod_offset
     *
     * @return Clip
     */
    public function setVodOffset(?int $vod_offset): Clip
    {
        $this->vod_offset = $vod_offset;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsFeatured(): bool
    {
        return $this->is_featured;
    }

    /**
     * @param bool $is_featured
     * @return void
     */
    public function setIsFeatured(bool $is_featured): void
    {
        $this->is_featured = $is_featured;
    }
}
