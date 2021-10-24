<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events\EventInterface;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Subscription;

class EventResponse
{
    protected ?string $challenge;

    protected Subscription $subscription;

    protected EventInterface $event;

    public function __construct(
        Subscription $subscription,
        ?string $challenge = null,
        ?EventInterface $event = null
    ) {
        $this->subscription = $subscription;
        $this->challenge = $challenge;
        $this->event = $event;
    }

    /**
     * @return string|null
     */
    public function getChallenge(): ?string
    {
        return $this->challenge;
    }

    /**
     * @return Subscription
     */
    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    /**
     * @return EventInterface
     */
    public function getEvent(): EventInterface
    {
        return $this->event;
    }

    /**
     * @return string
     */
    public function getEventType(): string
    {
        return $this->event::class;
    }
}
