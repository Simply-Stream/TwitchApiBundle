<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelAdBreakBeginEvent extends Event
{
    /**
     * @param int                $lengthSeconds        Length in seconds of the mid-roll ad break requested
     * @param \DateTimeImmutable $timestamp            The UTC timestamp of when the ad break began, in RFC3339 format. Note that there is
     *                                                 potential delay between this event, when the streamer requested the ad break, and
     *                                                 when the viewers will see ads.
     * @param bool               $isAutomatic          Indicates if the ad was automatically scheduled via Ads Manager
     * @param string             $requesterUserId      The ID of the user that requested the ad. For automatic ads, this will be the ID of
     *                                                 the broadcaster.
     * @param string             $broadcasterUserId    The broadcaster’s user ID for the channel the ad was run on.
     * @param string             $broadcasterUserLogin The broadcaster’s user login for the channel the ad was run on.
     * @param string             $broadcasterUserName  The broadcaster’s user display name for the channel the ad was run on.
     */
    public function __construct(
        private int $lengthSeconds,
        private \DateTimeImmutable $timestamp,
        private bool $isAutomatic,
        private string $requesterUserId,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
    ) {
    }

    public function getLengthSeconds(): int {
        return $this->lengthSeconds;
    }

    public function getTimestamp(): \DateTimeImmutable {
        return $this->timestamp;
    }

    public function isAutomatic(): bool {
        return $this->isAutomatic;
    }

    public function getRequesterUserId(): string {
        return $this->requesterUserId;
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
