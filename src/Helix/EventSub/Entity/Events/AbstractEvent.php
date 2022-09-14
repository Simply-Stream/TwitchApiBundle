<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

abstract class AbstractEvent implements EventInterface
{
    /**
     * @var string
     */
    protected $messageId;

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @param string $messageId
     *
     * @return AbstractEvent
     */
    public function setMessageId(string $messageId): AbstractEvent
    {
        $this->messageId = $messageId;

        return $this;
    }
}
