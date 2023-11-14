<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\Predictions\Outcome;

final readonly class ChannelPredictionLockEvent extends Event
{
    /**
     * @param string             $id                   Channel Points Prediction ID.
     * @param string             $broadcasterUserId    The requested broadcaster ID.
     * @param string             $broadcasterUserLogin The requested broadcaster login.
     * @param string             $broadcasterUserName  The requested broadcaster display name.
     * @param string             $title                Title for the Channel Points Prediction.
     * @param Outcome[]          $outcomes             An array of outcomes for the Channel Points Prediction. Includes top_predictors.
     * @param \DateTimeImmutable $startedAt            The time the Channel Points Prediction started.
     * @param \DateTimeImmutable $lockedAt             The time the Channel Points Prediction was locked.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $title,
        private array $outcomes,
        private \DateTimeImmutable $startedAt,
        private \DateTimeImmutable $lockedAt
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

    public function getTitle(): string {
        return $this->title;
    }

    public function getOutcomes(): array {
        return $this->outcomes;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getLockedAt(): \DateTimeImmutable {
        return $this->lockedAt;
    }
}
