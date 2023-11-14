<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelGuestStarGuestUpdateEvent extends Event
{
    /**
     * @param string      $broadcasterUserId    The broadcaster user ID
     * @param string      $broadcasterUserName  The broadcaster display name
     * @param string      $broadcasterUserLogin The broadcaster login
     * @param string      $sessionId            ID representing the unique session that was started.
     * @param string|null $moderatorUserId      The user ID of the moderator who updated the guest’s state (could be the host). null if the
     *                                          update was performed by the guest.
     * @param string|null $moderatorUserName    The moderator display name. null if the update was performed by the guest.
     * @param string|null $moderatorUserLogin   The moderator login. null if the update was performed by the guest.
     * @param string|null $guestUserId          The user ID of the guest who transitioned states in the session. null if the slot is now
     *                                          empty.
     * @param string|null $guestUserName        The guest display name. null if the slot is now empty.
     * @param string|null $guestUserLogin       The guest login. null if the slot is now empty.
     * @param string|null $slotId               The ID of the slot assignment the guest is assigned to. null if the guest is in the
     *                                          INVITED,
     *                                          REMOVED, READY, or ACCEPTED state.
     * @param string|null $state                The current state of the user after the update has taken place. null if the slot is now
     *                                          empty. Can otherwise be one of the following:
     *                                          - invited — The guest has transitioned to the invite queue. This can take place when the
     *                                          guest was previously assigned a slot, but have been removed from the call and are sent back
     *                                          to the invite queue.
     *                                          - accepted — The guest has accepted the invite and is currently in the process of setting
     *                                          up to join the session.
     *                                          - ready — The guest has signaled they are ready and can be assigned a slot.
     *                                          - backstage — The guest has been assigned a slot in the session, but is not currently seen
     *                                          live in the broadcasting software.
     *                                          - live — The guest is now live in the host's broadcasting software.
     *                                          - removed — The guest was removed from the call or queue.
     *                                          -- accepted — The guest has accepted the invite to the call.
     * @param bool|null   $hostVideoEnabled     Flag that signals whether the host is allowing the slot’s video to be seen by participants
     *                                          within the session. null if the guest is not slotted.
     * @param bool|null   $hostAudioEnabled     Flag that signals whether the host is allowing the slot’s audio to be heard by participants
     *                                          within the session. null if the guest is not slotted.
     * @param int|null    $hostVolume           Value between 0-100 that represents the slot’s audio level as heard by participants within
     *                                          the session. null if the guest is not slotted.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserName,
        private string $broadcasterUserLogin,
        private string $sessionId,
        private ?string $moderatorUserId = null,
        private ?string $moderatorUserName = null,
        private ?string $moderatorUserLogin = null,
        private ?string $guestUserId = null,
        private ?string $guestUserName = null,
        private ?string $guestUserLogin = null,
        private ?string $slotId = null,
        private ?string $state = null,
        private ?bool $hostVideoEnabled = null,
        private ?bool $hostAudioEnabled = null,
        private ?int $hostVolume = null,
    ) {
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getSessionId(): string {
        return $this->sessionId;
    }

    public function getModeratorUserId(): ?string {
        return $this->moderatorUserId;
    }

    public function getModeratorUserName(): ?string {
        return $this->moderatorUserName;
    }

    public function getModeratorUserLogin(): ?string {
        return $this->moderatorUserLogin;
    }

    public function getGuestUserId(): ?string {
        return $this->guestUserId;
    }

    public function getGuestUserName(): ?string {
        return $this->guestUserName;
    }

    public function getGuestUserLogin(): ?string {
        return $this->guestUserLogin;
    }

    public function getSlotId(): ?string {
        return $this->slotId;
    }

    public function getState(): ?string {
        return $this->state;
    }

    public function getHostVideoEnabled(): ?bool {
        return $this->hostVideoEnabled;
    }

    public function getHostAudioEnabled(): ?bool {
        return $this->hostAudioEnabled;
    }

    public function getHostVolume(): ?int {
        return $this->hostVolume;
    }
}
