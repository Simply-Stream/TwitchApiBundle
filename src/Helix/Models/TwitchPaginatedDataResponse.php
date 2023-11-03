<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models;

/**
 * @template T
 */
readonly class TwitchPaginatedDataResponse extends TwitchDataResponse implements TwitchPaginatedResponseInterface
{
    /**
     * @param T          $data
     * @param Pagination $pagination
     * @param int|null   $total
     */
    public function __construct(
        mixed $data,
        protected Pagination $pagination,
        protected ?int $total = null
    ) {
        parent::__construct($data);
    }

    public function getPagination(): Pagination {
        return $this->pagination;
    }

    public function getTotal(): ?int {
        return $this->total;
    }
}
