<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\Predictions\Outcome;

final readonly class ChannelPredictionEndEvent extends Event
{
    /**
     * @param string             $id                   Channel Points Prediction ID.
     * @param string             $broadcasterUserId    The requested broadcaster ID.
     * @param string             $broadcasterUserLogin The requested broadcaster login.
     * @param string             $broadcasterUserName  The requested broadcaster display name.
     * @param string             $title                Title for the Channel Points Prediction.
     * @param string             $winningOutcomeId     ID of the winning outcome.
     * @param Outcome[]          $outcomes             An array of outcomes for the Channel Points Prediction. Includes top_predictors.
     * @param string             $status               The status of the Channel Points Prediction. Valid values are resolved and canceled.
     * @param \DateTimeImmutable $startedAt            The time the Channel Points Prediction started.
     * @param \DateTimeImmutable $ended                The time the Channel Points Prediction ended.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $title,
        private string $winningOutcomeId,
        private array $outcomes,
        private string $status,
        private \DateTimeImmutable $startedAt,
        private \DateTimeImmutable $ended
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

    public function getWinningOutcomeId(): string {
        return $this->winningOutcomeId;
    }

    public function getOutcomes(): array {
        return $this->outcomes;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getEnded(): \DateTimeImmutable {
        return $this->ended;
    }
}
