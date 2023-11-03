<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Moderation;

final readonly class CheckAutoModStatusRequest
{
    /**
     * @param string $msgId   A caller-defined ID used to correlate this message with the same message in the response.
     * @param string $msgText The message to check.
     */
    public function __construct(
        private string $msgId,
        private string $msgText
    ) {
    }

    public function getMsgId(): string {
        return $this->msgId;
    }

    public function getMsgText(): string {
        return $this->msgText;
    }
}
