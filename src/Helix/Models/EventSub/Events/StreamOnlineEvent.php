<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class StreamOnlineEvent extends Event
{
    /**
     * @param string             $id                   The id of the stream.
     * @param string             $broadcasterUserId    The broadcaster’s user id.
     * @param string             $broadcasterUserLogin The broadcaster’s user login.
     * @param string             $broadcasterUserName  The broadcaster’s user display name.
     * @param string             $type                 The stream type. Valid values are: live, playlist, watch_party, premiere, rerun.
     * @param \DateTimeImmutable $startedAt            The timestamp at which the stream went online at.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $type,
        private \DateTimeImmutable $startedAt
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

    public function getType(): string {
        return $this->type;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }
}
