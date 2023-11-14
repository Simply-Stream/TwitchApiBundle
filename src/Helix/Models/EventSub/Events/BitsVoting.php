<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class BitsVoting
{
    use SerializesModels;

    /**
     * @param bool $isEnabled     Not used; will be set to false.
     * @param int  $amountPerVote Not used; will be set to 0.
     */
    public function __construct(
        private bool $isEnabled = false,
        private int $amountPerVote = 0
    ) {
    }

    public function isEnabled(): bool {
        return $this->isEnabled;
    }

    public function getAmountPerVote(): int {
        return $this->amountPerVote;
    }
}
