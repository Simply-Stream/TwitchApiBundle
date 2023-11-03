<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Chat;

use Webmozart\Assert\Assert;

final readonly class UpdateChatSettingsRequest
{
    /**
     * @param bool|null $emoteMode                     A Boolean value that determines whether chat messages must contain only emotes.
     *
     *                                                 Set to true if only emotes are allowed; otherwise, false. The default is false.
     * @param bool|null $followerMode                  A Boolean value that determines whether the broadcaster restricts the chat room to
     *                                                 followers only.
     *
     *                                                 Set to true if the broadcaster restricts the chat room to followers only; otherwise,
     *                                                 false. The default is true.
     *
     *                                                 To specify how long users must follow the broadcaster before being able to
     *                                                 participate in the chat room, see the follower_mode_duration field.
     * @param int|null  $followerModeDuration          The length of time, in minutes, that users must follow the broadcaster before being
     *                                                 able to participate in the chat room. Set only if follower_mode is true. Possible
     *                                                 values are: 0 (no restriction) through 129600 (3 months). The default is 0.
     * @param bool|null $nonModeratorChatDelay         A Boolean value that determines whether the broadcaster adds a short delay before
     *                                                 chat messages appear in the chat room. This gives chat moderators and bots a chance
     *                                                 to remove them before viewers can see the message.
     *
     *                                                 Set to true if the broadcaster applies a delay; otherwise, false. The default is
     *                                                 false.
     *
     *                                                 To specify the length of the delay, see the non_moderator_chat_delay_duration field.
     * @param int|null  $nonModeratorChatDelayDuration The amount of time, in seconds, that messages are delayed before appearing in chat.
     *                                                 Set only if non_moderator_chat_delay is true. Possible values are:
     *                                                 - 2 — 2 second delay (recommended)
     *                                                 - 4 — 4 second delay
     *                                                 - 6 — 6 second delay
     * @param bool|null $slowMode                      A Boolean value that determines whether the broadcaster limits how often users in
     *                                                 the chat room are allowed to send messages. Set to true if the broadcaster applies a
     *                                                 wait period between messages; otherwise, false. The default is false.
     *
     *                                                 To specify the delay, see the slow_mode_wait_time field.
     * @param int|null  $slowModeWaitTime              The amount of time, in seconds, that users must wait between sending messages. Set
     *                                                 only if slow_mode is true.
     *
     *                                                 Possible values are: 3 (3 second delay) through 120 (2 minute delay). The default is
     *                                                 30 seconds.
     * @param bool|null $subscriberMode                A Boolean value that determines whether only users that subscribe to the
     *                                                 broadcaster’s channel may talk in the chat room.
     *
     *                                                 Set to true if the broadcaster restricts the chat room to subscribers only;
     *                                                 otherwise, false. The default is false.
     * @param bool|null $uniqueChatMode                A Boolean value that determines whether the broadcaster requires users to post only
     *                                                 unique messages in the chat room.
     *
     *                                                 Set to true if the broadcaster allows only unique messages; otherwise, false. The
     *                                                 default is false.
     */
    public function __construct(
        private ?bool $emoteMode = null,
        private ?bool $followerMode = null,
        private ?int $followerModeDuration = null,
        private ?bool $nonModeratorChatDelay = null,
        private ?int $nonModeratorChatDelayDuration = null,
        private ?bool $slowMode = null,
        private ?int $slowModeWaitTime = null,
        private ?bool $subscriberMode = null,
        private ?bool $uniqueChatMode = null
    ) {
        if ($this->followerMode) {
            Assert::lessThanEq($this->followerModeDuration, 129600, 'Follower mode duration can\'t exceed 3 months (129600 seconds)');
        }

        if ($this->nonModeratorChatDelay) {
            Assert::inArray($this->nonModeratorChatDelayDuration, [2, 4, 6], 'Invalid non moderator chat delay duration. Allowed values: 2, 4, 6');
        }

        if ($this->slowMode) {
            Assert::greaterThanEq($this->slowModeWaitTime, 3, 'Slow mode minimum value is 3 seconds');
            Assert::lessThanEq($this->slowModeWaitTime, 120, 'Slow mode maximum value is 120 seconds');
        }
    }

    public function getEmoteMode(): ?bool {
        return $this->emoteMode;
    }

    public function getFollowerMode(): ?bool {
        return $this->followerMode;
    }

    public function getFollowerModeDuration(): ?int {
        return $this->followerModeDuration;
    }

    public function getNonModeratorChatDelay(): ?bool {
        return $this->nonModeratorChatDelay;
    }

    public function getNonModeratorChatDelayDuration(): ?int {
        return $this->nonModeratorChatDelayDuration;
    }

    public function getSlowMode(): ?bool {
        return $this->slowMode;
    }

    public function getSlowModeWaitTime(): ?int {
        return $this->slowModeWaitTime;
    }

    public function getSubscriberMode(): ?bool {
        return $this->subscriberMode;
    }

    public function getUniqueChatMode(): ?bool {
        return $this->uniqueChatMode;
    }
}
