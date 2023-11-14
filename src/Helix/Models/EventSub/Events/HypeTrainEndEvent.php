<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\HypeTrain\Contribution;

final readonly class HypeTrainEndEvent extends Event
{
    /**
     * @param string             $id                   The Hype Train ID.
     * @param string             $broadcasterUserId    The requested broadcaster ID.
     * @param string             $broadcasterUserLogin The requested broadcaster login.
     * @param string             $broadcasterUserName  The requested broadcaster display name.
     * @param int                $total                Total points contributed to the Hype Train.
     * @param Contribution       $topContributions     The contributors with the most points contributed.
     * @param int                $level                The final level of the Hype Train.
     * @param \DateTimeImmutable $startedAt            The time when the Hype Train started.
     * @param \DateTimeImmutable $expiresAt            The time when the Hype Train cooldown ends so that the next Hype Train can start.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private int $total,
        private Contribution $topContributions,
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

    public function getTopContributions(): Contribution {
        return $this->topContributions;
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
