<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Schedule;

use Webmozart\Assert\Assert;

class UpdateChannelStreamScheduleSegmentRequest
{
    /**
     * @param \DateTimeImmutable|null $startTime  The date and time that the broadcast segment starts. Specify the date and time in RFC3339
     *                                            format (for example, 2022-08-02T06:00:00Z).
     *
     *                                            NOTE: Only partners and affiliates may update a broadcast’s start time and only for
     *                                            non-recurring segments.
     * @param string|null             $duration   The length of time, in minutes, that the broadcast is scheduled to run. The duration must
     *                                            be in the range 30 through 1380 (23 hours).
     * @param string|null             $categoryId The ID of the category that best represents the broadcast’s content. To get the category
     *                                            ID, use the Search Categories endpoint.
     * @param string|null             $title      The broadcast’s title. The title may contain a maximum of 140 characters.
     * @param bool|null               $isCanceled A Boolean value that indicates whether the broadcast is canceled. Set to true to cancel
     *                                            the segment.
     *
     *                                            NOTE: For recurring segments, the API cancels the first segment after the current UTC
     *                                            date and time and not the specified segment (unless the specified segment is the next
     *                                            segment after the current UTC date and time).
     * @param string|null             $timezone   The time zone where the broadcast takes place. Specify the time zone using IANA time zone
     *                                            database format (for example, America/New_York).
     */
    public function __construct(
        private ?\DateTimeImmutable $startTime = null,
        private ?string $duration = null,
        private ?string $categoryId = null,
        private ?string $title = null,
        private ?bool $isCanceled = null,
        private ?string $timezone = null,
    ) {
        if (null !== $this->duration) {
            Assert::greaterThanEq($this->duration, 30, sprintf('The minimum duration is 30 minutes. Got "%s"', $this->duration));
            Assert::lessThanEq($this->duration, 1380, sprintf('The maximum duration is 1380 minutes (23 hours). Got "%s"', $this->duration));
        }

        if (null !== $this->title) {
            Assert::stringNotEmpty($this->title, 'Title can\'t be empty');
            Assert::maxLength($this->title, 140, sprintf('The maximum title length is 140 characters. Got %s', strlen($this->title)));
        }
    }

    public function getStartTime(): ?\DateTimeImmutable {
        return $this->startTime;
    }

    public function getDuration(): ?string {
        return $this->duration;
    }

    public function getCategoryId(): ?string {
        return $this->categoryId;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function getIsCanceled(): ?bool {
        return $this->isCanceled;
    }

    public function getTimezone(): ?string {
        return $this->timezone;
    }
}
