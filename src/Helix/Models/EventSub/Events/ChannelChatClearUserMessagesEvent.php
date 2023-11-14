<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelChatClearUserMessagesEvent extends Event
{
    /**
     * @param string $broadcasterUserId    The broadcaster user ID.
     * @param string $broadcasterUserLogin The broadcaster login.
     * @param string $broadcasterUserName  The broadcaster display name.
     * @param string $targetUserId         The ID of the user that was banned or put in a timeout. All of their messages are deleted.
     * @param string $targetUserLogin      The user login of the user that was banned or put in a timeout.
     * @param string $targetUserName       The user name of the user that was banned or put in a timeout.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $targetUserId,
        private string $targetUserLogin,
        private string $targetUserName,
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

    public function getTargetUserId(): string {
        return $this->targetUserId;
    }

    public function getTargetUserLogin(): string {
        return $this->targetUserLogin;
    }

    public function getTargetUserName(): string {
        return $this->targetUserName;
    }
}
