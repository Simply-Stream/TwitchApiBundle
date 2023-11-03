<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\GuestStar;

final readonly class GuestStarInvite
{
    /**
     * @param string             $userId           Twitch User ID corresponding to the invited guest
     * @param \DateTimeImmutable $invitedAt        Timestamp when this user was invited to the session.
     * @param string             $status           Status representing the invited user’s join state. Can be one of the following:
     *                                             - INVITED: The user has been invited to the session but has not acknowledged it.
     *                                             - ACCEPTED: The invited user has acknowledged the invite and joined the waiting room,
     *                                             but may still be setting up their media devices or otherwise preparing to join the call.
     *                                             - READY: The invited user has signaled they are ready to join the call from the waiting
     *                                             room.
     * @param bool               $isVideoEnabled   Flag signaling that the invited user has chosen to disable their local video device. The
     *                                             user has hidden themselves, but they may choose to reveal their video feed upon joining
     *                                             the session.
     * @param bool               $isAudioEnabled   Flag signaling that the invited user has chosen to disable their local audio device. The
     *                                             user has muted themselves, but they may choose to unmute their audio feed upon joining
     *                                             the session.
     * @param bool               $isVideoAvailable Flag signaling that the invited user has a video device available for sharing.
     * @param bool               $isAudioAvailable Flag signaling that the invited user has an audio device available for sharing.
     */
    public function __construct(
        private string $userId,
        private \DateTimeImmutable $invitedAt,
        private string $status,
        private bool $isVideoEnabled,
        private bool $isAudioEnabled,
        private bool $isVideoAvailable,
        private bool $isAudioAvailable,
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getInvitedAt(): \DateTimeImmutable {
        return $this->invitedAt;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function isVideoEnabled(): bool {
        return $this->isVideoEnabled;
    }

    public function isAudioEnabled(): bool {
        return $this->isAudioEnabled;
    }

    public function isVideoAvailable(): bool {
        return $this->isVideoAvailable;
    }

    public function isAudioAvailable(): bool {
        return $this->isAudioAvailable;
    }
}
