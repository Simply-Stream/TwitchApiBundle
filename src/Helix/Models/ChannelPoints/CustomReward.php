<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\ChannelPoints;

final readonly class CustomReward
{
    /**
     * @param string                     $broadcasterId                     The ID that uniquely identifies the broadcaster.
     * @param string                     $broadcasterLogin                  The broadcaster’s login name.
     * @param string                     $broadcasterName                   The broadcaster’s display name.
     * @param string                     $id                                The ID that uniquely identifies this custom reward.
     * @param string                     $title                             The title of the reward.
     * @param string                     $prompt                            The prompt shown to the viewer when they redeem the reward if
     *                                                                      user input is required (see the is_user_input_required field).
     * @param int                        $cost                              The cost of the reward in Channel Points.
     * @param array                      $image                             A set of custom images for the reward. This field is set to
     *                                                                      null if the broadcaster didn’t upload images.
     * @param array                      $defaultImage                      A set of default images for the reward.
     * @param string                     $backgroundColor                   The background color to use for the reward. The color is in Hex
     *                                                                      format (for example, #00E5CB).
     * @param bool                       $isEnabled                         A Boolean value that determines whether the reward is enabled.
     *                                                                      Is true if enabled; otherwise, false. Disabled rewards aren’t
     *                                                                      shown to the user.
     * @param bool                       $isUserInputRequired               A Boolean value that determines whether the user must enter
     *                                                                      information when redeeming the reward. Is true if the reward
     *                                                                      requires user input.
     * @param MaxPerStreamSetting        $maxPerStreamSetting               The settings used to determine whether to apply a maximum to
     *                                                                      the number to the redemptions allowed per live stream.
     * @param MaxPerUserPerStreamSetting $maxPerUserPerStreamSetting        The settings used to determine whether to apply a maximum to
     *                                                                      the number of redemptions allowed per user per live stream.
     * @param GlobalCooldownSetting      $globalCooldownSetting             The settings used to determine whether to apply a cooldown
     *                                                                      period between redemptions and the length of the cooldown.
     * @param bool                       $isPaused                          A Boolean value that determines whether the reward is currently
     *                                                                      paused. Is true if the reward is paused. Viewers can’t redeem
     *                                                                      paused rewards.
     * @param bool                       $isInStock                         A Boolean value that determines whether the reward is currently
     *                                                                      in stock. Is true if the reward is in stock. Viewers can’t
     *                                                                      redeem out of stock rewards.
     * @param bool                       $shouldRedemptionsSkipRequestQueue A Boolean value that determines whether redemptions should be
     *                                                                      set to FULFILLED status immediately when a reward is redeemed.
     *                                                                      If false, status is UNFULFILLED and follows the normal request
     *                                                                      queue process.
     * @param int                        $redemptionsRedeemedCurrentStream  The number of redemptions redeemed during the current live
     *                                                                      stream. The number counts against the max_per_stream_setting
     *                                                                      limit. This field is null if the broadcaster’s stream isn’t
     *                                                                      live or max_per_stream_setting isn’t enabled.
     * @param \DateTimeImmutable         $cooldownExpiresAt                 The timestamp of when the cooldown period expires. Is null if
     *                                                                      the reward isn’t in a cooldown state (see the
     *                                                                      global_cooldown_setting field).
     */
    public function __construct(
        private string $broadcasterId,
        private string $broadcasterLogin,
        private string $broadcasterName,
        private string $id,
        private string $title,
        private string $prompt,
        private int $cost,
        private array $image,
        private array $defaultImage,
        private string $backgroundColor,
        private bool $isEnabled,
        private bool $isUserInputRequired,
        private MaxPerStreamSetting $maxPerStreamSetting,
        private MaxPerUserPerStreamSetting $maxPerUserPerStreamSetting,
        private GlobalCooldownSetting $globalCooldownSetting,
        private bool $isPaused,
        private bool $isInStock,
        private bool $shouldRedemptionsSkipRequestQueue,
        private int $redemptionsRedeemedCurrentStream,
        private \DateTimeImmutable $cooldownExpiresAt
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getPrompt(): string {
        return $this->prompt;
    }

    public function getCost(): int {
        return $this->cost;
    }

    public function getImage(): array {
        return $this->image;
    }

    public function getDefaultImage(): array {
        return $this->defaultImage;
    }

    public function getBackgroundColor(): string {
        return $this->backgroundColor;
    }

    public function isEnabled(): bool {
        return $this->isEnabled;
    }

    public function isUserInputRequired(): bool {
        return $this->isUserInputRequired;
    }

    public function getMaxPerStreamSetting(): MaxPerStreamSetting {
        return $this->maxPerStreamSetting;
    }

    public function getMaxPerUserPerStreamSetting(): MaxPerUserPerStreamSetting {
        return $this->maxPerUserPerStreamSetting;
    }

    public function getGlobalCooldownSetting(): GlobalCooldownSetting {
        return $this->globalCooldownSetting;
    }

    public function isPaused(): bool {
        return $this->isPaused;
    }

    public function isInStock(): bool {
        return $this->isInStock;
    }

    public function isShouldRedemptionsSkipRequestQueue(): bool {
        return $this->shouldRedemptionsSkipRequestQueue;
    }

    public function getRedemptionsRedeemedCurrentStream(): int {
        return $this->redemptionsRedeemedCurrentStream;
    }

    public function getCooldownExpiresAt(): \DateTimeImmutable {
        return $this->cooldownExpiresAt;
    }
}
