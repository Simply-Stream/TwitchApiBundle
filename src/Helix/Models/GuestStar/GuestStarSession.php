<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\GuestStar;

final readonly class GuestStarSession
{
    /**
     * @param string             $id              ID uniquely representing the Guest Star session.
     * @param array              $guests          List of guests currently interacting with the Guest Star session.
     *                                            Note: Sadly, Twitch is unable to describe this type
     * @param string             $slotId          ID representing this guest’s slot assignment.
     *                                            - Host is always in slot "0"
     *                                            - Guests are assigned the following consecutive IDs (e.g, "1", "2", "3", etc)
     *                                            - Screen Share is represented as a special guest with the ID "SCREENSHARE"
     *                                            - The identifier here matches the ID referenced in browser source links used in
     *                                            broadcasting software.
     * @param bool               $isLive          Flag determining whether or not the guest is visible in the browser source in the host’s
     *                                            streaming software.
     * @param string             $userId          User ID of the guest assigned to this slot.
     * @param string             $userDisplayName Display name of the guest assigned to this slot.
     * @param string             $userLogin       Login of the guest assigned to this slot.
     * @param int                $volume          Value from 0 to 100 representing the host’s volume setting for this guest.
     * @param \DateTimeImmutable $assignedAt      Timestamp when this guest was assigned a slot in the session.
     * @param MediaSettings      $audioSettings   Information about the guest’s audio settings
     * @param MediaSettings      $videoSettings   Information about the guest’s video settings
     */
    public function __construct(
        private string $id,
        private array $guests,
        private string $slotId,
        private bool $isLive,
        private string $userId,
        private string $userDisplayName,
        private string $userLogin,
        private int $volume,
        private \DateTimeImmutable $assignedAt,
        private MediaSettings $audioSettings,
        private MediaSettings $videoSettings
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getGuests(): array {
        return $this->guests;
    }

    public function getSlotId(): string {
        return $this->slotId;
    }

    public function isLive(): bool {
        return $this->isLive;
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserDisplayName(): string {
        return $this->userDisplayName;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getVolume(): int {
        return $this->volume;
    }

    public function getAssignedAt(): \DateTimeImmutable {
        return $this->assignedAt;
    }

    public function getAudioSettings(): MediaSettings {
        return $this->audioSettings;
    }

    public function getVideoSettings(): MediaSettings {
        return $this->videoSettings;
    }
}
