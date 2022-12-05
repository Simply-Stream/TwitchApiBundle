<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ChatSettings
{
    /**
     * The ID of the broadcaster specified in the request.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * A Boolean value that determines whether chat messages must contain only emotes. Is true if chat messages may contain only emotes;
     * otherwise, false.
     *
     * @var bool
     */
    protected bool $emote_mode;

    /**
     * A Boolean value that determines whether the broadcaster restricts the chat room to followers only.
     *
     * Is true if the broadcaster restricts the chat room to followers only; otherwise, false.
     *
     * See the follower_mode_duration field for how long users must follow the broadcaster before being able to participate in the chat
     * room.
     *
     * @var bool
     */
    protected bool $follower_mode;

    /**
     * The length of time, in minutes, that users must follow the broadcaster before being able to participate in the chat room. Is null if
     * follower_mode is false.
     *
     * @var int
     */
    protected int $follower_mode_duration;

    /**
     * The moderator’s ID. The response includes this field only if the request specifies a user access token that includes the
     * moderator:read:chat_settings scope.
     *
     * @var string
     */
    protected string $moderator_id;

    /**
     * A Boolean value that determines whether the broadcaster adds a short delay before chat messages appear in the chat room. This gives
     * chat moderators and bots a chance to remove them before viewers can see the message. See the non_moderator_chat_delay_duration field
     * for the length of the delay. Is true if the broadcaster applies a delay; otherwise, false.
     *
     * The response includes this field only if the request specifies a user access token that includes the moderator:read:chat_settings
     * scope and the user in the moderator_id query parameter is one of the broadcaster’s moderators.
     *
     * @var bool
     */
    protected bool $non_moderator_chat_delay;

    /**
     * The amount of time, in seconds, that messages are delayed before appearing in chat. Is null if non_moderator_chat_delay is false.
     *
     * The response includes this field only if the request specifies a user access token that includes the moderator:read:chat_settings
     * scope and the user in the moderator_id query parameter is one of the broadcaster’s moderators.
     *
     * @var int
     */
    protected int $non_moderator_chat_delay_duration;

    /**
     * A Boolean value that determines whether the broadcaster limits how often users in the chat room are
     * allowed to send messages.
     *
     * Is true if the broadcaster applies a delay; otherwise, false.
     *
     * See the slow_mode_wait_time field for the delay.
     *
     * @var bool
     */
    protected bool $slow_mode;

    /**
     * The amount of time, in seconds, that users must wait between sending messages.
     *
     * Is null if slow_mode is false.
     *
     * @var int
     */
    protected int $slow_mode_wait_time;

    /**
     * A Boolean value that determines whether only users that subscribe to the broadcaster’s channel may talk in the chat room.
     *
     * Is true if the broadcaster restricts the chat room to subscribers only; otherwise, false.
     *
     * @var bool
     */
    protected bool $subscriber_mode;

    /**
     * A Boolean value that determines whether the broadcaster requires users to post only unique messages in the chat room.
     *
     * Is true if the broadcaster requires unique messages only; otherwise, false.
     *
     * @var bool
     */
    protected bool $unique_chat_mode;

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
     * @return ChatSettings
     */
    public function setBroadcasterId(string $broadcaster_id): ChatSettings
    {
        $this->broadcaster_id = $broadcaster_id;

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmoteMode(): bool
    {
        return $this->emote_mode;
    }

    /**
     * @param bool $emote_mode
     *
     * @return ChatSettings
     */
    public function setEmoteMode(bool $emote_mode): ChatSettings
    {
        $this->emote_mode = $emote_mode;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFollowerMode(): bool
    {
        return $this->follower_mode;
    }

    /**
     * @param bool $follower_mode
     *
     * @return ChatSettings
     */
    public function setFollowerMode(bool $follower_mode): ChatSettings
    {
        $this->follower_mode = $follower_mode;

        return $this;
    }

    /**
     * @return int
     */
    public function getFollowerModeDuration(): int
    {
        return $this->follower_mode_duration;
    }

    /**
     * @param int $follower_mode_duration
     *
     * @return ChatSettings
     */
    public function setFollowerModeDuration(int $follower_mode_duration): ChatSettings
    {
        $this->follower_mode_duration = $follower_mode_duration;

        return $this;
    }

    /**
     * @return string
     */
    public function getModeratorId(): string
    {
        return $this->moderator_id;
    }

    /**
     * @param string $moderator_id
     *
     * @return ChatSettings
     */
    public function setModeratorId(string $moderator_id): ChatSettings
    {
        $this->moderator_id = $moderator_id;

        return $this;
    }

    /**
     * @return bool
     */
    public function isNonModeratorChatDelay(): bool
    {
        return $this->non_moderator_chat_delay;
    }

    /**
     * @param bool $non_moderator_chat_delay
     *
     * @return ChatSettings
     */
    public function setNonModeratorChatDelay(bool $non_moderator_chat_delay): ChatSettings
    {
        $this->non_moderator_chat_delay = $non_moderator_chat_delay;

        return $this;
    }

    /**
     * @return int
     */
    public function getNonModeratorChatDelayDuration(): int
    {
        return $this->non_moderator_chat_delay_duration;
    }

    /**
     * @param int $non_moderator_chat_delay_duration
     *
     * @return ChatSettings
     */
    public function setNonModeratorChatDelayDuration(int $non_moderator_chat_delay_duration): ChatSettings
    {
        $this->non_moderator_chat_delay_duration = $non_moderator_chat_delay_duration;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSlowMode(): bool
    {
        return $this->slow_mode;
    }

    /**
     * @param bool $slow_mode
     *
     * @return ChatSettings
     */
    public function setSlowMode(bool $slow_mode): ChatSettings
    {
        $this->slow_mode = $slow_mode;

        return $this;
    }

    /**
     * @return int
     */
    public function getSlowModeWaitTime(): int
    {
        return $this->slow_mode_wait_time;
    }

    /**
     * @param int $slow_mode_wait_time
     *
     * @return ChatSettings
     */
    public function setSlowModeWaitTime(int $slow_mode_wait_time): ChatSettings
    {
        $this->slow_mode_wait_time = $slow_mode_wait_time;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSubscriberMode(): bool
    {
        return $this->subscriber_mode;
    }

    /**
     * @param bool $subscriber_mode
     *
     * @return ChatSettings
     */
    public function setSubscriberMode(bool $subscriber_mode): ChatSettings
    {
        $this->subscriber_mode = $subscriber_mode;

        return $this;
    }

    /**
     * @return bool
     */
    public function isUniqueChatMode(): bool
    {
        return $this->unique_chat_mode;
    }

    /**
     * @param bool $unique_chat_mode
     *
     * @return ChatSettings
     */
    public function setUniqueChatMode(bool $unique_chat_mode): ChatSettings
    {
        $this->unique_chat_mode = $unique_chat_mode;

        return $this;
    }
}
