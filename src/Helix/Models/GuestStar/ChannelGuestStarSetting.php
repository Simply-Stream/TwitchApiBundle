<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\GuestStar;

final readonly class ChannelGuestStarSetting
{
    /**
     * @param bool   $isModeratorSendLiveEnabled  Flag determining if Guest Star moderators have access to control whether a guest is live
     *                                            once assigned to a slot.
     * @param int    $slotCount                   Number of slots the Guest Star call interface will allow the host to add to a call.
     *                                            Required to be between 1 and 6.
     * @param bool   $isBrowserSourceAudioEnabled Flag determining if Browser Sources subscribed to sessions on this channel should output
     *                                            audio
     * @param string $groupLayout                 This setting determines how the guests within a session should be laid out within the
     *                                            browser source. Can be one of the following values:
     *                                            - TILED_LAYOUT: All live guests are tiled within the browser source with the same size.
     *                                            - SCREENSHARE_LAYOUT: All live guests are tiled within the browser source with the same
     *                                            size. If there is an active screen share, it is sized larger than the other guests.
     * @param string $browserSourceToken          View only token to generate browser source URLs
     */
    public function __construct(
        private bool $isModeratorSendLiveEnabled,
        private int $slotCount,
        private bool $isBrowserSourceAudioEnabled,
        private string $groupLayout,
        private string $browserSourceToken
    ) {
    }

    public function isModeratorSendLiveEnabled(): bool {
        return $this->isModeratorSendLiveEnabled;
    }

    public function getSlotCount(): int {
        return $this->slotCount;
    }

    public function isBrowserSourceAudioEnabled(): bool {
        return $this->isBrowserSourceAudioEnabled;
    }

    public function getGroupLayout(): string {
        return $this->groupLayout;
    }

    public function getBrowserSourceToken(): string {
        return $this->browserSourceToken;
    }
}
