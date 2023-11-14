<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class StreamOfflineEvent extends Event
{
    /**
     * @param string $broadcasterUserId    The broadcaster’s user id.
     * @param string $broadcasterUserLogin The broadcaster’s user login.
     * @param string $broadcasterUserName  The broadcaster’s user display name.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,

    ) {
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
}
