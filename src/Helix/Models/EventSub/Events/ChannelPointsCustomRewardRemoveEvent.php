<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\Chat\Image;

final readonly class ChannelPointsCustomRewardRemoveEvent extends Event
{
    /**
     * @param string                  $id                                The reward identifier.
     * @param string                  $broadcasterUserId                 The requested broadcaster ID.
     * @param string                  $broadcasterUserLogin              The requested broadcaster login.
     * @param string                  $broadcasterUserName               The requested broadcaster display name.
     * @param bool                    $isEnabled                         Is the reward currently enabled. If false, the reward won’t show
     *                                                                   up to viewers.
     * @param bool                    $isPaused                          Is the reward currently paused. If true, viewers can’t redeem.
     * @param bool                    $isInStock                         Is the reward currently in stock. If false, viewers can’t redeem.
     * @param string                  $title                             The reward title.
     * @param int                     $cost                              The reward cost.
     * @param string                  $prompt                            The reward description.
     * @param bool                    $isUserInputRequired               Does the viewer need to enter information when redeeming the
     *                                                                   reward.
     * @param bool                    $shouldRedemptionsSkipRequestQueue Should redemptions be set to fulfilled status immediately when
     *                                                                   redeemed and skip the request queue instead of the normal
     *                                                                   unfulfilled status.
     * @param MaxPerStream            $maxPerStream                      Whether a maximum per stream is enabled and what the maximum is.
     * @param MaxPerUserPerStream     $maxPerUserPerStream               Whether a maximum per user per stream is enabled and what the
     *                                                                   maximum is.
     * @param string                  $backgroundColor                   Custom background color for the reward. Format: Hex with # prefix.
     *                                                                   Example: #FA1ED2.
     * @param Image                   $image                             Set of custom images of 1x, 2x and 4x sizes for the reward. Can be
     *                                                                   null if no images have been uploaded.
     * @param Image                   $defaultImage                      Set of default images of 1x, 2x and 4x sizes for the reward.
     * @param GlobalCooldown          $globalCooldown                    Whether a cooldown is enabled and what the cooldown is in seconds.
     * @param \DateTimeImmutable|null $cooldownExpiresAt                 Timestamp of the cooldown expiration. null if the reward isn’t on
     *                                                                   cooldown.
     * @param int|null                $redemptionsRedeemedCurrentStrea   The number of redemptions redeemed during the current live stream.
     *                                                                   Counts against the max_per_stream limit. null if the broadcasters
     *                                                                   stream isn’t live or max_per_stream isn’t enabled.
     */
    public function __construct(
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private bool $isEnabled,
        private bool $isPaused,
        private bool $isInStock,
        private string $title,
        private int $cost,
        private string $prompt,
        private bool $isUserInputRequired,
        private bool $shouldRedemptionsSkipRequestQueue,
        private MaxPerStream $maxPerStream,
        private MaxPerUserPerStream $maxPerUserPerStream,
        private string $backgroundColor,
        private Image $image,
        private Image $defaultImage,
        private GlobalCooldown $globalCooldown,
        private ?\DateTimeImmutable $cooldownExpiresAt = null,
        private ?int $redemptionsRedeemedCurrentStrea = null
    ) {
    }

    public function getId(): string {
        return $this->id;
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

    public function isEnabled(): bool {
        return $this->isEnabled;
    }

    public function isPaused(): bool {
        return $this->isPaused;
    }

    public function isInStock(): bool {
        return $this->isInStock;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getCost(): int {
        return $this->cost;
    }

    public function getPrompt(): string {
        return $this->prompt;
    }

    public function isUserInputRequired(): bool {
        return $this->isUserInputRequired;
    }

    public function isShouldRedemptionsSkipRequestQueue(): bool {
        return $this->shouldRedemptionsSkipRequestQueue;
    }

    public function getMaxPerStream(): MaxPerStream {
        return $this->maxPerStream;
    }

    public function getMaxPerUserPerStream(): MaxPerUserPerStream {
        return $this->maxPerUserPerStream;
    }

    public function getBackgroundColor(): string {
        return $this->backgroundColor;
    }

    public function getImage(): Image {
        return $this->image;
    }

    public function getDefaultImage(): Image {
        return $this->defaultImage;
    }

    public function getGlobalCooldown(): GlobalCooldown {
        return $this->globalCooldown;
    }

    public function getCooldownExpiresAt(): ?\DateTimeImmutable {
        return $this->cooldownExpiresAt;
    }

    public function getRedemptionsRedeemedCurrentStrea(): ?int {
        return $this->redemptionsRedeemedCurrentStrea;
    }
}
