<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Ads;

final readonly class AdSchedule
{
    /**
     * @param int                $snoozeCount            The number of snoozes available for the broadcaster.
     * @param \DateTimeImmutable $snoozeRefreshAt        The UTC timestamp when the broadcaster will gain an additional snooze, in RFC3339
     *                                                   format.
     * @param \DateTimeImmutable $nextAdAt               The UTC timestamp of the broadcaster’s next scheduled ad, in RFC3339 format. Empty
     *                                                   if the channel has no ad scheduled or is not live.
     * @param int                $lengthSeconds          The length in seconds of the scheduled upcoming ad break.
     * @param \DateTimeImmutable $lastAdAt               The UTC timestamp of the broadcaster’s last ad-break, in RFC3339 format. Empty if
     *                                                   the channel has not run an ad or is not live.
     * @param int                $prerollFreeTimeSeconds The amount of pre-roll free time remaining for the channel in seconds. Returns 0
     *                                                   if they are currently not pre-roll free.
     */
    public function __construct(
        private int $snoozeCount,
        private \DateTimeImmutable $snoozeRefreshAt,
        private \DateTimeImmutable $nextAdAt,
        private int $lengthSeconds,
        private \DateTimeImmutable $lastAdAt,
        private int $prerollFreeTimeSeconds
    ) {
    }

    public function getSnoozeCount(): int {
        return $this->snoozeCount;
    }

    public function getSnoozeRefreshAt(): string {
        return $this->snoozeRefreshAt;
    }

    public function getNextAdAt(): \DateTimeImmutable {
        return $this->nextAdAt;
    }

    public function getLengthSeconds(): int {
        return $this->lengthSeconds;
    }

    public function getLastAdAt(): \DateTimeImmutable {
        return $this->lastAdAt;
    }

    public function getPrerollFreeTimeSeconds(): int {
        return $this->prerollFreeTimeSeconds;
    }
}
