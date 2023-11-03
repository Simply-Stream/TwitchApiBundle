<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Streams;

final readonly class Marker
{
    /**
     * @param string             $id              An ID that identifies this marker.
     * @param \DateTimeImmutable $createdAt       The UTC date and time (in RFC3339 format) of when the user created the marker.
     * @param int                $positionSeconds The relative offset (in seconds) of the marker from the beginning of the stream.
     * @param string             $description     A description that the user gave the marker to help them remember why they marked the
     *                                            location.
     */
    public function __construct(
        private string $id,
        private \DateTimeImmutable $createdAt,
        private int $positionSeconds,
        private string $description
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getPositionSeconds(): int {
        return $this->positionSeconds;
    }

    public function getDescription(): string {
        return $this->description;
    }
}
