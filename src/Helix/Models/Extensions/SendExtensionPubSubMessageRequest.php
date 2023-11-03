<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

use Webmozart\Assert\Assert;

final readonly class SendExtensionPubSubMessageRequest
{
    /**
     * @param array       $target            The target of the message. Possible values are:
     *                                       - broadcast
     *                                       - global
     *                                       - whisper-<user-id>
     *                                       If is_global_broadcast is true, you must set this field to global. The broadcast and global
     *                                       values are mutually exclusive; specify only one of them.
     * @param string      $message           The message to send. The message can be a plain-text string or a string-encoded JSON object.
     *                                       The message is limited to a maximum of 5 KB.
     * @param bool        $isGlobalBroadcast A Boolean value that determines whether the message should be sent to all channels where your
     *                                       extension is active. Set to true if the message should be sent to all channels. The default is
     *                                       false.
     * @param string|null $broadcasterId     The ID of the broadcaster to send the message to. Don’t include this field if
     *                                       is_global_broadcast is set to true.
     */
    public function __construct(
        private array $target,
        private string $message,
        private bool $isGlobalBroadcast = false,
        private ?string $broadcasterId = null,
    ) {
        Assert::allIsInstanceOf($this->target, 'string', 'Target can only be an array of strings');

        if ($this->isGlobalBroadcast) {
            Assert::null($this->broadcasterId, 'Broadcaster ID should not be included, when isGlobalBroadcast is set to true');
            Assert::allEq($this->target, 'global', 'When isGlobalBroadcast is set to true, target has to be set to "global"');
        } else {
            Assert::allRegex($this->target, '^(broadcast|global|whisper-\d+)$', 'Target got an invalid value. Possible values are: broadcast, global, whisper-USER_ID.');
        }
    }

    public function getTarget(): array {
        return $this->target;
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function isGlobalBroadcast(): bool {
        return $this->isGlobalBroadcast;
    }

    public function getMessage(): string {
        return $this->message;
    }
}
