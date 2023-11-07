<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition\ConditionInterface;

final readonly class Subscription
{
    /**
     * @param string             $id        An ID that identifies the subscription.
     * @param string             $status    The subscription’s status. The subscriber receives events only for enabled subscriptions.
     *                                      Possible values are:
     *                                      - enabled — The subscription is enabled.
     *                                      - webhook_callback_verification_pending — The subscription is pending verification of the
     *                                      specified callback URL (see Responding to a challenge request).
     * @param string             $type      The subscription’s type.
     * @param string             $version   The version number that identifies this definition of the subscription’s data.
     * @param ConditionInterface $condition The subscription’s parameter values. This is a string-encoded JSON object whose contents are
     *                                      determined by the subscription type.
     * @param \DateTimeImmutable $createdAt The date and time (in RFC3339 format) of when the subscription was created.
     * @param Transport          $transport The transport details used to send the notifications.
     */
    public function __construct(
        private string $id,
        private string $status,
        private string $type,
        private string $version,
        private ConditionInterface $condition,
        private \DateTimeImmutable $createdAt,
        private Transport $transport,
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getVersion(): string {
        return $this->version;
    }

    public function getCondition(): ConditionInterface {
        return $this->condition;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getTransport(): Transport {
        return $this->transport;
    }
}
