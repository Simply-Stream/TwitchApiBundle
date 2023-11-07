<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub;

use SimplyStream\TwitchApiBundle\Helix\Models\TwitchDataResponse;

/**
 * @template T
 * @extends TwitchDataResponse<T>
 */
final readonly class EventSubResponse extends TwitchDataResponse
{
    /**
     * @param T   $data
     * @param int $total
     * @param int $totalCost
     * @param int $maxTotalCost
     */
    public function __construct(
        mixed $data,
        private int $total,
        private int $totalCost,
        private int $maxTotalCost
    ) {
        parent::__construct($data);
    }

    public function getTotal(): int {
        return $this->total;
    }

    public function getTotalCost(): int {
        return $this->totalCost;
    }

    public function getMaxTotalCost(): int {
        return $this->maxTotalCost;
    }
}
