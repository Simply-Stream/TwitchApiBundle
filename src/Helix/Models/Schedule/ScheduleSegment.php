<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Schedule;

final readonly class ScheduleSegment
{
    /**
     * @param string                          $id            An ID that identifies this broadcast segment.
     * @param \DateTimeImmutable              $startTime     The UTC date and time (in RFC3339 format) of when the broadcast starts.
     * @param \DateTimeImmutable              $endTime       The UTC date and time (in RFC3339 format) of when the broadcast ends.
     * @param string                          $title         The broadcast segment’s title.
     *                                                       broadcast. If the broadcaster canceled this segment, this field is set to the
     *                                                       same value that’s in the end_time field; otherwise, it’s set to null.
     * @param array{id: string, name: string} $category      The type of content that the broadcaster plans to stream or null if not
     *                                                       specified.The type of content that the broadcaster plans to stream or null if
     *                                                       not specified.
     * @param bool                            $isRecurring   A Boolean value that determines whether the broadcast is part of a recurring
     *                                                       series that streams at the same time each week or is a one-time broadcast. Is
     *                                                       true if the broadcast is part of a recurring series.
     * @param \DateTimeImmutable|null         $canceledUntil Indicates whether the broadcaster canceled this segment of a recurring
     */
    public function __construct(
        private string $id,
        private \DateTimeImmutable $startTime,
        private \DateTimeImmutable $endTime,
        private string $title,
        private array $category,
        private bool $isRecurring,
        private ?\DateTimeImmutable $canceledUntil = null
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getStartTime(): \DateTimeImmutable {
        return $this->startTime;
    }

    public function getEndTime(): \DateTimeImmutable {
        return $this->endTime;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getCanceledUntil(): ?\DateTimeImmutable {
        return $this->canceledUntil;
    }

    public function getCategory(): array {
        return $this->category;
    }

    public function isRecurring(): bool {
        return $this->isRecurring;
    }
}
