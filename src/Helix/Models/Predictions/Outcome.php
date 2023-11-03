<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Predictions;

final readonly class Outcome
{
    /**
     * @param string $id            An ID that identifies this outcome.
     * @param string $title         The outcome’s text.
     * @param int    $users         The number of unique viewers that chose this outcome.
     * @param int    $channelPoints The number of Channel Points spent by viewers on this outcome.
     * @param array  $topPredictors A list of viewers who were the top predictors; otherwise, null if none.
     * @param string $color         The color that visually identifies this outcome in the UX. Possible values are:
     *                              - BLUE
     *                              - PINK
     *                              If the number of outcomes is two, the color is BLUE for the first outcome and PINK for the second
     *                              outcome. If there are more than two outcomes, the color is BLUE for all outcomes.
     */
    public function __construct(
        private string $id,
        private string $title,
        private int $users,
        private int $channelPoints,
        private array $topPredictors,
        private string $color,
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getUsers(): int {
        return $this->users;
    }

    public function getChannelPoints(): int {
        return $this->channelPoints;
    }

    public function getTopPredictors(): array {
        return $this->topPredictors;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function getPredictionWindow(): int {
        return $this->predictionWindow;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getEndedAt(): \DateTimeImmutable {
        return $this->endedAt;
    }

    public function getLockedAt(): \DateTimeImmutable {
        return $this->lockedAt;
    }
}
