<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\HypeTrain;

final readonly class EventData
{
    /**
     * @param string             $broadcasterId    The ID of the broadcaster that’s running the Hype Train.
     * @param \DateTimeImmutable $cooldownEndTime  The UTC date and time (in RFC3339 format) that another Hype Train can start.
     * @param \DateTimeImmutable $expiresAt        The UTC date and time (in RFC3339 format) that the Hype Train ends.
     * @param int                $goal             The value needed to reach the next level.
     * @param string             $id               An ID that identifies this Hype Train.
     * @param Contribution       $lastContribution The most recent contribution towards the Hype Train’s goal.
     * @param int                $level            The highest level that the Hype Train reached (the levels are 1 through 5).
     * @param \DateTimeImmutable $startedAt        The UTC date and time (in RFC3339 format) that this Hype Train started.
     * @param Contribution[]     $topContributions The top contributors for each contribution type. For example, the top contributor using
     *                                             BITS (by aggregate) and the top contributor using SUBS (by count).
     */
    public function __construct(
        private string $broadcasterId,
        private \DateTimeImmutable $cooldownEndTime,
        private \DateTimeImmutable $expiresAt,
        private int $goal,
        private string $id,
        private Contribution $lastContribution,
        private int $level,
        private \DateTimeImmutable $startedAt,
        private array $topContributions,
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getCooldownEndTime(): \DateTimeImmutable {
        return $this->cooldownEndTime;
    }

    public function getExpiresAt(): \DateTimeImmutable {
        return $this->expiresAt;
    }

    public function getGoal(): int {
        return $this->goal;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getLastContribution(): Contribution {
        return $this->lastContribution;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getTopContributions(): array {
        return $this->topContributions;
    }
}
