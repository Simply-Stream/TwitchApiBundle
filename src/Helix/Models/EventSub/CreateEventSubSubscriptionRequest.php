<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub;

final readonly class CreateEventSubSubscriptionRequest
{
    /**
     * @param string $type      The type of subscription to create. For a list of subscriptions that you can create, see Subscription
     *                          Types. Set this field to the value in the Name column of the Subscription Types table.
     * @param string $version   The version number that identifies the definition of the subscription type that you want the response to
     *                          use.
     * @param array  $condition A JSON object that contains the parameter values that are specific to the specified subscription type. For
     *                          the object’s required and optional fields, see the subscription type’s documentation.
     * @param array  $transport The transport details that you want Twitch to use when sending you notifications.
     */
    public function __construct(
        private string $type,
        private string $version,
        private array $condition,
        private array $transport
    ) {
    }

    public function getType(): string {
        return $this->type;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getCondition(): array {
        return $this->condition;
    }

    public function getTransport(): array {
        return $this->transport;
    }
}
