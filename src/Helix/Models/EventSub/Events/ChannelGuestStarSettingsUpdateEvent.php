<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelGuestStarSettingsUpdateEvent extends Event
{
    /**
     * @param string $broadcasterUserId           User ID of the host channel
     * @param string $broadcasterUserName         The broadcaster display name
     * @param string $broadcasterUserLogin        The broadcaster login
     * @param bool   $isModeratorSendLiveEnabled  Flag determining if Guest Star moderators have access to control whether a guest is live
     *                                            once assigned to a slot.
     * @param int    $slotCount                   Number of slots the Guest Star call interface will allow the host to add to a call.
     * @param bool   $isBrowserSourceAudioEnabled Flag determining if browser sources subscribed to sessions on this channel should output
     *                                            audio
     * @param string $groupLayout                 This setting determines how the guests within a session should be laid out within a group
     *                                            browser source. Can be one of the following values:
     *                                            - tiled — All live guests are tiled within the browser source with the same size.
     *                                            - screenshare — All live guests are tiled within the browser source with the same size.
     *                                            If there is an active screen share, it is sized larger than the other guests.
     *                                            - horizontal_top — Indicates the group layout will contain all participants in a
     *                                            top-aligned horizontal stack.
     *                                            - horizontal_bottom — Indicates the group layout will contain all participants in a
     *                                            bottom-aligned horizontal stack.
     *                                            - vertical_left — Indicates the group layout will contain all participants in a
     *                                            left-aligned vertical stack.
     *                                            - vertical_right — Indicates the group layout will contain all participants in a
     *                                            right-aligned vertical stack.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserName,
        private string $broadcasterUserLogin,
        private bool $isModeratorSendLiveEnabled,
        private int $slotCount,
        private bool $isBrowserSourceAudioEnabled,
        private string $groupLayout
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
}
