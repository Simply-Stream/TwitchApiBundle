<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

interface EventInterface
{
    /**
     * Sets the messageId sent by twitch to avoid duplicates
     *
     * @param string $messageId
     *
     * @return $this
     */
    public function setMessageId(string $messageId): self;

    /**
     * Returns the messageId
     *
     * @return string
     */
    public function getMessageId(): string;
}
