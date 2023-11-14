<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelPollEndEvent extends Event
{
    /**
     * @param string              $id                   ID of the poll.
     * @param string              $broadcasterUserId    The requested broadcaster ID.
     * @param string              $broadcasterUserLogin The requested broadcaster login.
     * @param string              $broadcasterUserName  The requested broadcaster display name.
     * @param string              $title                Question displayed for the poll.
     * @param array               $choices              An array of choices for the poll. Includes vote counts.
     * @param BitsVoting          $bitsVoting           Not supported.
     * @param ChannelPointsVoting $channelPointsVoting  The Channel Points voting settings for the poll.
     * @param string              $status               The status of the poll. Valid values are completed, archived, and terminated.
     * @param \DateTimeImmutable  $startedAt            The time the poll started.
     * @param \DateTimeImmutable  $endedAt              The time the poll ended.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $title,
        private array $choices,
        private BitsVoting $bitsVoting,
        private ChannelPointsVoting $channelPointsVoting,
        private string $status,
        private \DateTimeImmutable $startedAt,
        private \DateTimeImmutable $endedAt
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

    public function getChoices(): array {
        return $this->choices;
    }

    public function getBitsVoting(): BitsVoting {
        return $this->bitsVoting;
    }

    public function getChannelPointsVoting(): ChannelPointsVoting {
        return $this->channelPointsVoting;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getEndedAt(): \DateTimeImmutable {
        return $this->endedAt;
    }
}
