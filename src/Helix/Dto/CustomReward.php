<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class CustomReward
{
    /**
     * The ID that uniquely identifies the broadcaster.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * The broadcaster’s login name.
     *
     * @var string
     */
    protected string $broadcaster_login;

    /**
     * The broadcaster’s display name.
     *
     * @var string
     */
    protected string $broadcaster_name;

    /**
     * The ID that uniquely identifies this custom reward.
     *
     * @var string
     */
    protected string $id;

    /**
     * The title of the reward.
     *
     * @var string
     */
    protected string $title;

    /**
     * The prompt shown to the viewer when they redeem the reward if user input is required (see the is_user_input_required field).
     *
     * @var string
     */
    protected string $prompt;

    /**
     * The cost of the reward in Channel Points.
     *
     * @var int
     */
    protected int $cost;

    /**
     * A set of custom images for the reward. This field is set to null if the broadcaster didn’t upload images.
     *
     * @var array
     */
    protected array $image;

    /**
     * A set of default images for the reward.
     *
     * @var array
     */
    protected array $default_image;

    /**
     * The background color to use for the reward. The color is in Hex format (for example, #00E5CB).
     *
     * @var string
     */
    protected string $background_color;

    /**
     * A Boolean value that determines whether the reward is enabled. Is true if enabled; otherwise, false.
     * Disabled rewards aren’t shown to the user.
     *
     * @var bool
     */
    protected bool $is_enabled;

    /**
     * A Boolean value that determines whether the user must enter information when redeeming the reward. Is true if the reward requires
     * user input.
     *
     * @var bool
     */
    protected bool $is_user_input_required;

    /**
     * The settings used to determine whether to apply a maximum to the number to the redemptions allowed per live stream.
     *
     * @var array
     */
    protected array $max_per_stream_setting;

    /**
     * The settings used to determine whether to apply a maximum to the number of redemptions allowed per user per live stream.
     *
     * @var array
     */
    protected array $max_per_user_per_stream_setting;

    /**
     * The settings used to determine whether to apply a cooldown period between redemptions and the length of the cooldown.
     *
     * @var array
     */
    protected array $global_cooldown_setting;

    /**
     * A Boolean value that determines whether the reward is currently paused. Is true if the reward is paused. Viewers can’t redeem
     * paused rewards.
     *
     * @var bool
     */
    protected bool $is_paused;

    /**
     * A Boolean value that determines whether the reward is currently in stock. Is true if the reward is in stock. Viewers can’t redeem
     * out of stock rewards.
     *
     * @var bool
     */
    protected bool $is_in_stock;

    /**
     * A Boolean value that determines whether redemptions should be set to FULFILLED status immediately when a reward is redeemed.
     * if false, status is UNFULFILLED and follows the normal request queue process.
     *
     * @var bool
     */
    protected bool $should_redemptions_skip_request_queue;

    /**
     * The number of redemptions redeemed during the current live stream. The number counts against the max_per_stream_setting limit. This
     * field is null if the broadcaster’s stream isn’t live or max_per_stream_setting isn’t enabled.
     *
     * @var int
     */
    protected int $redemptions_redeemed_current_stream;

    /**
     * The timestamp of when the cooldown period expires. Is null if the reward isn’t in a cooldown state (see the global_cooldown_setting
     * field).
     *
     * @var string
     */
    protected string $cooldown_expires_at;

    /**
     * @return string
     */
    public function getBroadcasterId(): string
    {
        return $this->broadcaster_id;
    }

    /**
     * @param string $broadcaster_id
     *
     * @return CustomReward
     */
    public function setBroadcasterId(string $broadcaster_id): CustomReward
    {
        $this->broadcaster_id = $broadcaster_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterLogin(): string
    {
        return $this->broadcaster_login;
    }

    /**
     * @param string $broadcaster_login
     *
     * @return CustomReward
     */
    public function setBroadcasterLogin(string $broadcaster_login): CustomReward
    {
        $this->broadcaster_login = $broadcaster_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterName(): string
    {
        return $this->broadcaster_name;
    }

    /**
     * @param string $broadcaster_name
     *
     * @return CustomReward
     */
    public function setBroadcasterName(string $broadcaster_name): CustomReward
    {
        $this->broadcaster_name = $broadcaster_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return CustomReward
     */
    public function setId(string $id): CustomReward
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return CustomReward
     */
    public function setTitle(string $title): CustomReward
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrompt(): string
    {
        return $this->prompt;
    }

    /**
     * @param string $prompt
     *
     * @return CustomReward
     */
    public function setPrompt(string $prompt): CustomReward
    {
        $this->prompt = $prompt;

        return $this;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     *
     * @return CustomReward
     */
    public function setCost(int $cost): CustomReward
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return array
     */
    public function getImage(): array
    {
        return $this->image;
    }

    /**
     * @param array $image
     *
     * @return CustomReward
     */
    public function setImage(array $image): CustomReward
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultImage(): array
    {
        return $this->default_image;
    }

    /**
     * @param array $default_image
     *
     * @return CustomReward
     */
    public function setDefaultImage(array $default_image): CustomReward
    {
        $this->default_image = $default_image;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->background_color;
    }

    /**
     * @param string $background_color
     *
     * @return CustomReward
     */
    public function setBackgroundColor(string $background_color): CustomReward
    {
        $this->background_color = $background_color;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsEnabled(): bool
    {
        return $this->is_enabled;
    }

    /**
     * @param bool $is_enabled
     *
     * @return CustomReward
     */
    public function setIsEnabled(bool $is_enabled): CustomReward
    {
        $this->is_enabled = $is_enabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsUserInputRequired(): bool
    {
        return $this->is_user_input_required;
    }

    /**
     * @param bool $is_user_input_required
     *
     * @return CustomReward
     */
    public function setIsUserInputRequired(bool $is_user_input_required): CustomReward
    {
        $this->is_user_input_required = $is_user_input_required;

        return $this;
    }

    /**
     * @return array
     */
    public function getMaxPerStreamSetting(): array
    {
        return $this->max_per_stream_setting;
    }

    /**
     * @param array $max_per_stream_setting
     *
     * @return CustomReward
     */
    public function setMaxPerStreamSetting(array $max_per_stream_setting): CustomReward
    {
        $this->max_per_stream_setting = $max_per_stream_setting;

        return $this;
    }

    /**
     * @return array
     */
    public function getMaxPerUserPerStreamSetting(): array
    {
        return $this->max_per_user_per_stream_setting;
    }

    /**
     * @param array $max_per_user_per_stream_setting
     *
     * @return CustomReward
     */
    public function setMaxPerUserPerStreamSetting(array $max_per_user_per_stream_setting): CustomReward
    {
        $this->max_per_user_per_stream_setting = $max_per_user_per_stream_setting;

        return $this;
    }

    /**
     * @return array
     */
    public function getGlobalCooldownSetting(): array
    {
        return $this->global_cooldown_setting;
    }

    /**
     * @param array $global_cooldown_setting
     *
     * @return CustomReward
     */
    public function setGlobalCooldownSetting(array $global_cooldown_setting): CustomReward
    {
        $this->global_cooldown_setting = $global_cooldown_setting;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsPaused(): bool
    {
        return $this->is_paused;
    }

    /**
     * @param bool $is_paused
     *
     * @return CustomReward
     */
    public function setIsPaused(bool $is_paused): CustomReward
    {
        $this->is_paused = $is_paused;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsInStock(): bool
    {
        return $this->is_in_stock;
    }

    /**
     * @param bool $is_in_stock
     *
     * @return CustomReward
     */
    public function setIsInStock(bool $is_in_stock): CustomReward
    {
        $this->is_in_stock = $is_in_stock;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShouldRedemptionsSkipRequestQueue(): bool
    {
        return $this->should_redemptions_skip_request_queue;
    }

    /**
     * @param bool $should_redemptions_skip_request_queue
     *
     * @return CustomReward
     */
    public function setShouldRedemptionsSkipRequestQueue(bool $should_redemptions_skip_request_queue): CustomReward
    {
        $this->should_redemptions_skip_request_queue = $should_redemptions_skip_request_queue;

        return $this;
    }

    /**
     * @return int
     */
    public function getRedemptionsRedeemedCurrentStream(): int
    {
        return $this->redemptions_redeemed_current_stream;
    }

    /**
     * @param int $redemptions_redeemed_current_stream
     *
     * @return CustomReward
     */
    public function setRedemptionsRedeemedCurrentStream(int $redemptions_redeemed_current_stream): CustomReward
    {
        $this->redemptions_redeemed_current_stream = $redemptions_redeemed_current_stream;

        return $this;
    }

    /**
     * @return string
     */
    public function getCooldownExpiresAt(): string
    {
        return $this->cooldown_expires_at;
    }

    /**
     * @param string $cooldown_expires_at
     *
     * @return CustomReward
     */
    public function setCooldownExpiresAt(string $cooldown_expires_at): CustomReward
    {
        $this->cooldown_expires_at = $cooldown_expires_at;

        return $this;
    }
}
