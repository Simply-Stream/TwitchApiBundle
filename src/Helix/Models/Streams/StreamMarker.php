<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Streams;

final readonly class StreamMarker
{
    /**
     * @param string   $userId    The ID of the user that created the marker.
     * @param string   $userName  The user’s display name.
     * @param string   $userLogin The user’s login name.
     * @param array    $videos    A list of videos that contain markers. The list contains a single video.
     * @param Marker[] $markers   The list of markers in this video. The list in ascending order by when the marker was created.
     */
    public function __construct(
        private string $userId,
        private string $userName,
        private string $userLogin,
        private array $videos,
        private array $markers
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getVideos(): array {
        return $this->videos;
    }

    public function getMarkers(): array {
        return $this->markers;
    }
}
