<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class BitsBadgeTier
{
    use SerializesModels;

    /**
     * @param int $tier The tier of the Bits badge the user just earned. For example, 100, 1000, or 10000.
     */
    public function __construct(
        private int $tier
    ) {
    }

    public function getTier(): int {
        return $this->tier;
    }
}
