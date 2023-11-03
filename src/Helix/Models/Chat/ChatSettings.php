<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Chat;

final readonly class ChatSettings
{
    /**
     * @param string $broadcasterId                 The ID of the broadcaster specified in the request.
     * @param bool   $emoteMode                     A Boolean value that determines whether chat messages must contain only emotes. Is true
     *                                              if chat messages may contain only emotes; otherwise, false.
     * @param bool   $followerMode                  A Boolean value that determines whether the broadcaster restricts the chat room to
     *                                              followers only.
     *
     *                                              Is true if the broadcaster restricts the chat room to followers only; otherwise, false.
     *
     *                                              See the follower_mode_duration field for how long users must follow the broadcaster
     *                                              before being able to participate in the chat room.
     * @param int    $followerModeDuration          The length of time, in minutes, that users must follow the broadcaster before being
     *                                              able to participate in the chat room. Is null if follower_mode is false.
     * @param string $moderatorId                   The moderator’s ID. The response includes this field only if the request specifies a
     *                                              user access token that includes the moderator:read:chat_settings scope.
     * @param bool   $nonModeratorChatDelay         A Boolean value that determines whether the broadcaster adds a short delay before chat
     *                                              messages appear in the chat room. This gives chat moderators and bots a chance to
     *                                              remove them before viewers can see the message. See the
     *                                              non_moderator_chat_delay_duration field for the length of the delay. Is true if the
     *                                              broadcaster applies a delay; otherwise, false.
     *
     *                                              The response includes this field only if the request specifies a user access token that
     *                                              includes the moderator:read:chat_settings scope and the user in the moderator_id query
     *                                              parameter is one of the broadcaster’s moderators.
     * @param int    $nonModeratorChatDelayDuration The amount of time, in seconds, that messages are delayed before appearing in chat. Is
     *                                              null if non_moderator_chat_delay is false.
     *
     *                                              The response includes this field only if the request specifies a user access token that
     *                                              includes the moderator:read:chat_settings scope and the user in the moderator_id query
     *                                              parameter is one of the broadcaster’s moderators.
     * @param bool   $slowMode                      A Boolean value that determines whether the broadcaster limits how often users in the
     *                                              chat room are allowed to send messages.
     *
     *                                              Is true if the broadcaster applies a delay; otherwise, false.
     *
     *                                              See the slow_mode_wait_time field for the delay.
     * @param int    $slowModeWaitTime              The amount of time, in seconds, that users must wait between sending messages.
     *
     *                                              Is null if slow_mode is false.
     * @param bool   $subscriberMode                A Boolean value that determines whether only users that subscribe to the broadcaster’s
     *                                              channel may talk in the chat room.
     *
     *                                              Is true if the broadcaster restricts the chat room to subscribers only; otherwise,
     *                                              false.
     * @param bool   $uniqueChatMode                A Boolean value that determines whether the broadcaster requires users to post only
     *                                              unique messages in the chat room.
     *
     *                                              Is true if the broadcaster requires unique messages only; otherwise, false.
     */
    public function __construct(
        private string $broadcasterId,
        private bool $emoteMode,
        private bool $followerMode,
        private int $followerModeDuration,
        private string $moderatorId,
        private bool $nonModeratorChatDelay,
        private int $nonModeratorChatDelayDuration,
        private bool $slowMode,
        private int $slowModeWaitTime,
        private bool $subscriberMode,
        private bool $uniqueChatMode
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function isEmoteMode(): bool {
        return $this->emoteMode;
    }

    public function isFollowerMode(): bool {
        return $this->followerMode;
    }

    public function getFollowerModeDuration(): int {
        return $this->followerModeDuration;
    }

    public function getModeratorId(): string {
        return $this->moderatorId;
    }

    public function isNonModeratorChatDelay(): bool {
        return $this->nonModeratorChatDelay;
    }

    public function getNonModeratorChatDelayDuration(): int {
        return $this->nonModeratorChatDelayDuration;
    }

    public function isSlowMode(): bool {
        return $this->slowMode;
    }

    public function getSlowModeWaitTime(): int {
        return $this->slowModeWaitTime;
    }

    public function isSubscriberMode(): bool {
        return $this->subscriberMode;
    }

    public function isUniqueChatMode(): bool {
        return $this->uniqueChatMode;
    }
}
