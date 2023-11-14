<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Raid
{
    use SerializesModels;

    /**
     * @param string $userId          The user ID of the broadcaster raiding this channel.
     * @param string $userName        The user name of the broadcaster raiding this channel.
     * @param string $userLogin       The login name of the broadcaster raiding this channel.
     * @param int    $viewerCount     The number of viewers raiding this channel from the broadcaster’s channel.
     * @param string $profileImageUrl Profile image URL of the broadcaster raiding this channel.
     */
    public function __construct(
        private string $userId,
        private string $userName,
        private string $userLogin,
        private int $viewerCount,
        private string $profileImageUrl
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getViewerCount(): int {
        return $this->viewerCount;
    }

    public function getProfileImageUrl(): string {
        return $this->profileImageUrl;
    }
}
