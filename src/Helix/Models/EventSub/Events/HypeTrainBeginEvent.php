<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\HypeTrain\Contribution;

final readonly class HypeTrainBeginEvent extends Event
{
    /**
     * @param string             $id                   The Hype Train ID.
     * @param string             $broadcasterUserId    The requested broadcaster ID.
     * @param string             $broadcasterUserLogin The requested broadcaster login.
     * @param string             $broadcasterUserName  The requested broadcaster display name.
     * @param int                $total                Total points contributed to the Hype Train.
     * @param int                $progress             The number of points contributed to the Hype Train at the current level.
     * @param int                $goal                 The number of points required to reach the next level.
     * @param Contribution       $topContributions     The contributors with the most points contributed.
     * @param Contribution       $lastContributions    The most recent contribution.
     * @param int                $level                The starting level of the Hype Train.
     * @param \DateTimeImmutable $startedAt            The time when the Hype Train started.
     * @param \DateTimeImmutable $expiresAt            The time when the Hype Train expires. The expiration is extended when the Hype Train
     *                                                 reaches a new level.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private int $total,
        private int $progress,
        private int $goal,
        private Contribution $topContributions,
        private Contribution $lastContributions,
        private int $level,
        private \DateTimeImmutable $startedAt,
        private \DateTimeImmutable $expiresAt
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
    }

    public function getTotal(): int {
        return $this->total;
    }

    public function getProgress(): int {
        return $this->progress;
    }

    public function getGoal(): int {
        return $this->goal;
    }

    public function getTopContributions(): Contribution {
        return $this->topContributions;
    }

    public function getLastContributions(): Contribution {
        return $this->lastContributions;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getExpiresAt(): \DateTimeImmutable {
        return $this->expiresAt;
    }
}
