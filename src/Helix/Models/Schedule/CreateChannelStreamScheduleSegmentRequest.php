<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Schedule;

use Webmozart\Assert\Assert;

final readonly class CreateChannelStreamScheduleSegmentRequest
{
    /**
     * @param \DateTimeImmutable $startTime   The date and time that the broadcast segment starts. Specify the date and time in RFC3339
     *                                        format (for example, 2021-07-01T18:00:00Z).
     * @param string             $timezone    The time zone where the broadcast takes place. Specify the time zone using IANA time zone
     *                                        database format (for example, America/New_York).
     * @param string             $duration    The length of time, in minutes, that the broadcast is scheduled to run. The duration must be
     *                                        in the range 30 through 1380 (23 hours).
     * @param bool|null          $isRecurring A Boolean value that determines whether the broadcast recurs weekly. Is true if the broadcast
     *                                        recurs weekly. Only partners and affiliates may add non-recurring broadcasts.
     * @param string|null        $categoryId  The ID of the category that best represents the broadcast’s content. To get the category ID,
     *                                        use the Search Categories endpoint.
     * @param string|null        $title       The broadcast’s title. The title may contain a maximum of 140 characters.
     */
    public function __construct(
        private \DateTimeImmutable $startTime,
        private string $timezone,
        private string $duration,
        private ?bool $isRecurring = null,
        private ?string $categoryId = null,
        private ?string $title = null
    ) {
        Assert::greaterThanEq($this->duration, 30, sprintf('The minimum duration is 30 minutes. Got "%s"', $this->duration));
        Assert::lessThanEq($this->duration, 1380, sprintf('The maximum duration is 1380 minutes (23 hours). Got "%s"', $this->duration));

        if (null !== $this->title) {
            Assert::stringNotEmpty($this->title, 'Title can\'t be empty');
            Assert::maxLength($this->title, 140, sprintf('The maximum title length is 140 characters. Got %s', strlen($this->title)));
        }
    }

    public function getStartTime(): \DateTimeImmutable {
        return $this->startTime;
    }

    public function getTimezone(): string {
        return $this->timezone;
    }

    public function getDuration(): string {
        return $this->duration;
    }

    public function isRecurring(): bool {
        return $this->isRecurring;
    }

    public function getCategoryId(): string {
        return $this->categoryId;
    }

    public function getTitle(): string {
        return $this->title;
    }
}
