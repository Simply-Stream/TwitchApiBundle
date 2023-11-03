<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\HypeTrain;

final readonly class HypeTrainEvent
{
    /**
     * @param string             $id             An ID that identifies this event.
     * @param string             $eventType      The type of event. The string is in the form, hypetrain.{event_name}. The request returns
     *                                           only progress event types (i.e., hypetrain.progression).
     * @param \DateTimeImmutable $eventTimestamp The UTC date and time (in RFC3339 format) that the event occurred.
     * @param string             $version        The version number of the definition of the event’s data. For example, the value is 1 if
     *                                           the data in event_data uses the first definition of the event’s data.
     * @param EventData          $event_data     The event’s data.
     * @param int                $total          The current total amount raised.
     */
    public function __construct(
        private string $id,
        private string $eventType,
        private \DateTimeImmutable $eventTimestamp,
        private string $version,
        private EventData $event_data,
        private int $total
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getEventType(): string {
        return $this->eventType;
    }

    public function getEventTimestamp(): \DateTimeImmutable {
        return $this->eventTimestamp;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getEventData(): EventData {
        return $this->event_data;
    }

    public function getTotal(): int {
        return $this->total;
    }
}
