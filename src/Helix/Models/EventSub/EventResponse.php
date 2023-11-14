<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\EventInterface;

/**
 * @template Tsubscription
 * @template Tevent
 */
final readonly class EventResponse
{
    /**
     * @param Tsubscription $subscription  Metadata about the subscription.
     * @param Tevent        $event         Returns the user ID, user name, title, language, category ID, category name, and content
     *                                     classification labels for the given broadcaster.
     * @param string|null   $challenge     Your response must return a 200 status code, the response body must contain the raw challenge
     *                                     value, and you must set the Content-Type response header to the length of the challenge value
     */
    public function __construct(
        private Subscription $subscription,
        private EventInterface $event,
        private ?string $challenge = null
    ) {
    }

    public function getSubscription(): Subscription {
        return $this->subscription;
    }

    public function getEvent(): EventInterface {
        return $this->event;
    }

    public function getChallenge(): ?string {
        return $this->challenge;
    }
}
