<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

/**
 * @template T
 */
readonly class TwitchResponse implements TwitchResponseInterface, TwitchPaginatedResponseInterface
{
    /**
     * @param T $data
     * @param array{cursor?: string}|null $pagination
     * @param int|null $total
     * @param string|null $template
     */
    public function __construct(
        protected mixed   $data,
        protected ?array  $pagination = null,
        protected ?int    $total = null,
        protected ?string $template = null
    )
    {
    }

    /**
     * @return T
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @return array|null
     */
    public function getPagination(): ?array
    {
        return $this->pagination;
    }

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }
}
