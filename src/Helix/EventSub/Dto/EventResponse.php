<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

use JMS\Serializer\Annotation as Serializer;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events\EventInterface;

class EventResponse
{
    /**
     * @var Subscription
     * @Serializer\Type("SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Subscription<T1>")
     */
    protected Subscription $subscription;

    /**
     * @var EventInterface|null
     * @Serializer\Type("T2")
     */
    protected ?EventInterface $event;

    /**
     * @var string|null
     */
    protected ?string $challenge;

    /**
     * @return Subscription
     */
    public function getSubscription(): Subscription
    {
        return $this->subscription;
    }

    /**
     * @param Subscription $subscription
     *
     * @return EventResponse
     */
    public function setSubscription(Subscription $subscription): EventResponse
    {
        $this->subscription = $subscription;

        return $this;
    }

    /**
     * @return EventInterface|null
     */
    public function getEvent(): ?EventInterface
    {
        return $this->event;
    }

    /**
     * @param EventInterface|null $event
     *
     * @return EventResponse
     */
    public function setEvent(?EventInterface $event): EventResponse
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getChallenge(): ?string
    {
        return $this->challenge;
    }

    /**
     * @param string|null $challenge
     *
     * @return EventResponse
     */
    public function setChallenge(?string $challenge): EventResponse
    {
        $this->challenge = $challenge;

        return $this;
    }
}
