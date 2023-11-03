<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\GuestStar;

final readonly class MediaSettings
{
    /**
     * @param bool $isHostEnabled  Flag determining whether the host is allowing the guest’s audio to be seen or heard within the session.
     * @param bool $isGuestEnabled Flag determining whether the guest is allowing their audio to be transmitted to the session.
     * @param bool $isAvailable    Flag determining whether the guest has an appropriate audio device available to be transmitted to the
     *                             session.
     */
    public function __construct(
        private bool $isHostEnabled,
        private bool $isGuestEnabled,
        private bool $isAvailable
    ) {
    }

    public function isHostEnabled(): bool {
        return $this->isHostEnabled;
    }

    public function isGuestEnabled(): bool {
        return $this->isGuestEnabled;
    }

    public function isAvailable(): bool {
        return $this->isAvailable;
    }
}
