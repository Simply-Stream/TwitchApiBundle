<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\GuestStar;

use Webmozart\Assert\Assert;

final readonly class UpdateChannelGuestStarSettingRequest
{
    /**
     * @param bool|null   $isModeratorSendLiveEnabled  Flag determining if Guest Star moderators have access to control whether a guest is
     *                                                 live once assigned to a slot.
     * @param int|null    $slotCount                   Number of slots the Guest Star call interface will allow the host to add to a call.
     *                                                 Required to be between 1 and 6.
     * @param bool|null   $isBrowserSourceAudioEnabled Flag determining if Browser Sources subscribed to sessions on this channel should
     *                                                 output audio
     * @param string|null $groupLayout                 This setting determines how the guests within a session should be laid out within
     *                                                 the browser source. Can be one of the following values:
     *                                                 - TILED_LAYOUT: All live guests are tiled within the browser source with the same
     *                                                 size.
     *                                                 - SCREENSHARE_LAYOUT: All live guests are tiled within the browser source with the
     *                                                 same size. If there is an active screen share, it is sized larger than the other
     *                                                 guests.
     *                                                 - HORIZONTAL_LAYOUT: All live guests are arranged in a horizontal bar within the
     *                                                 browser source
     *                                                 - VERTICAL_LAYOUT: All live guests are arranged in a vertical bar within the browser
     *                                                 source
     * @param bool|null   $regenerateBrowserSources    Flag determining if Guest Star should regenerate the auth token associated with the
     *                                                 channel’s browser sources. Providing a true value for this will immediately
     *                                                 invalidate all browser sources previously configured in your streaming software.
     */
    public function __construct(
        private ?bool $isModeratorSendLiveEnabled = null,
        private ?int $slotCount = null,
        private ?bool $isBrowserSourceAudioEnabled = null,
        private ?string $groupLayout = null,
        private ?bool $regenerateBrowserSources = null
    ) {
        if (null !== $this->slotCount) {
            Assert::greaterThanEq($this->slotCount, 1, 'Slot count needs to be at least 1');
            Assert::lessThanEq($this->slotCount, 6, 'Slot count should be less than or equal 6');
        }

        if (null !== $this->groupLayout) {
            Assert::inArray(
                $this->groupLayout, [
                'TILED_LAYOUT',
                'SCREENSHARE_LAYOUT',
                'HORIZONTAL_LAYOUT',
                'VERTICAL_LAYOUT'
            ],
                'Group layout got an invalid value. Allowed values are: TILED_LAYOUT, SCREENSHARE_LAYOUT, HORIZONTAL_LAYOUT, VERTICAL_LAYOUT'
            );
        }
    }

    public function toArray(): array {
        return [];
    }

    public function getIsModeratorSendLiveEnabled(): ?bool {
        return $this->isModeratorSendLiveEnabled;
    }

    public function getSlotCount(): ?int {
        return $this->slotCount;
    }

    public function getIsBrowserSourceAudioEnabled(): ?bool {
        return $this->isBrowserSourceAudioEnabled;
    }

    public function getGroupLayout(): ?string {
        return $this->groupLayout;
    }

    public function getRegenerateBrowserSources(): ?bool {
        return $this->regenerateBrowserSources;
    }
}
