<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class TwitchResponse implements TwitchResponseInterface
{
    /**
     * @var array
     */
    protected array $data;

    /**
     * @var array|null
     */
    protected ?array $pagination;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return TwitchResponse
     */
    public function setData(array $data): TwitchResponse
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getPagination(): ?array
    {
        return $this->pagination;
    }

    /**
     * @param array|null $pagination
     *
     * @return TwitchResponse
     */
    public function setPagination(?array $pagination): TwitchResponse
    {
        $this->pagination = $pagination;

        return $this;
    }
}
