<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class CommunityGiftSubscription
{
    use SerializesModels;

    /**
     * @param string   $id              The ID of the associated community gift.
     * @param int      $total           Number of subscriptions being gifted.
     * @param string   $subTier         The type of subscription plan being used. Possible values are:
     *                                  - 1000 — First level of paid subscription
     *                                  - 2000 — Second level of paid subscription
     *                                  - 3000 — Third level of paid subscription
     * @param int|null $cumulativeTotal Optional. The amount of gifts the gifter has given in this channel. Null if anonymous.
     */
    public function __construct(
        private string $id,
        private int $total,
        private string $subTier,
        private ?int $cumulativeTotal = null
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTotal(): int {
        return $this->total;
    }

    public function getSubTier(): string {
        return $this->subTier;
    }

    public function getCumulativeTotal(): ?int {
        return $this->cumulativeTotal;
    }
}
