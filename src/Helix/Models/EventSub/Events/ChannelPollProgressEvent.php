<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelPollProgressEvent extends Event
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
     * @param \DateTimeImmutable  $startedAt            The time the poll started.
     * @param \DateTimeImmutable  $endsAt               The time the poll will end.
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
        private \DateTimeImmutable $startedAt,
        private \DateTimeImmutable $endsAt
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

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getEndsAt(): \DateTimeImmutable {
        return $this->endsAt;
    }
}
