<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\EventInterface;

final readonly class EventResponse
{
    public const EVENTS = [
    ];

    /**
     * @param Subscription   $subscription Metadata about the subscription.
     * @param EventInterface $event        Returns the user ID, user name, title, language, category ID, category name, and content
     *                                     classification labels for the given broadcaster.
     */
    public function __construct(
        private Subscription $subscription,
        private EventInterface $event
    ) {
    }

    public function getSubscription(): Subscription {
        return $this->subscription;
    }

    public function getEvent(): EventInterface {
        return $this->event;
    }
}
