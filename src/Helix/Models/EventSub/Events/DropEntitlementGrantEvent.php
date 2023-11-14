<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class DropEntitlementGrantEvent extends Event
{
    /**
     * @param string                   $id   Individual event ID, as assigned by EventSub. Use this for de-duplicating messages.
     * @param DropEntitlementGrantData $data Entitlement object.
     */
    public function __construct(
        private string $id,
        private DropEntitlementGrantData $data
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getData(): DropEntitlementGrantData {
        return $this->data;
    }
}
