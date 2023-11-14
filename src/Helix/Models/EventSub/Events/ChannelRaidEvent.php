<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelRaidEvent extends Event
{
    /**
     * @param string $fromBroadcasterId    The broadcaster ID that created the raid.
     * @param string $fromBroadcasterLogin The broadcaster login that created the raid.
     * @param string $fromBroadcasterName  The broadcaster display name that created the raid.
     * @param string $toBroadcasterId      The broadcaster ID that received the raid.
     * @param string $toBroadcasterLogin   The broadcaster login that received the raid.
     * @param string $toBroadcasterName    The broadcaster display name that received the raid.
     * @param int    $viewers              The number of viewers in the raid.
     */
    public function __construct(
        private string $fromBroadcasterId,
        private string $fromBroadcasterLogin,
        private string $fromBroadcasterName,
        private string $toBroadcasterId,
        private string $toBroadcasterLogin,
        private string $toBroadcasterName,
        private int $viewers
    ) {
    }

    public function getFromBroadcasterId(): string {
        return $this->fromBroadcasterId;
    }

    public function getFromBroadcasterLogin(): string {
        return $this->fromBroadcasterLogin;
    }

    public function getFromBroadcasterName(): string {
        return $this->fromBroadcasterName;
    }

    public function getToBroadcasterId(): string {
        return $this->toBroadcasterId;
    }

    public function getToBroadcasterLogin(): string {
        return $this->toBroadcasterLogin;
    }

    public function getToBroadcasterName(): string {
        return $this->toBroadcasterName;
    }

    public function getViewers(): int {
        return $this->viewers;
    }
}
