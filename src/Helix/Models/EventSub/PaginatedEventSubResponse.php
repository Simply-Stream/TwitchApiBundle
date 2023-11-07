<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub;

use SimplyStream\TwitchApiBundle\Helix\Models\Pagination;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchPaginatedDataResponse;

/**
 * @template T
 * @extends TwitchPaginatedDataResponse<T>
 */
final readonly class PaginatedEventSubResponse extends TwitchPaginatedDataResponse
{
    /**
     * @param T $data
     * @param Pagination $pagination
     * @param int        $total
     * @param int        $totalCost
     * @param int        $maxTotalCost
     */
    public function __construct(
        mixed $data,
        Pagination $pagination,
        int $total,
        private int $totalCost,
        private int $maxTotalCost
    ) {
        parent::__construct($data, $pagination, $total);
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
