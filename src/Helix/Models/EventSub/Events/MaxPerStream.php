<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class MaxPerStream
{
    use SerializesModels;

    /**
     * @param bool $isEnabled Is the setting enabled.
     * @param int  $value     The max per stream limit.
     */
    public function __construct(
        private bool $isEnabled,
        private int $value
    ) {
    }

    public function isEnabled(): bool {
        return $this->isEnabled;
    }

    public function getValue(): int {
        return $this->value;
    }
}
