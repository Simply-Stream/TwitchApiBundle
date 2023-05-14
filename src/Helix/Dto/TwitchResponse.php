<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

use JMS\Serializer\Annotation as Serializer;

class TwitchResponse implements TwitchResponseInterface
{
    /**
     * @var mixed
     * @Serializer\Type("T")
     */
    protected mixed $data;

    /**
     * @var array|null
     * @Serializer\Type("array")
     */
    protected ?array $pagination;

    /**
     * @var int|null
     */
    protected ?int $total = null;

    /**
     * @var string|null
     */
    protected ?string $template = null;

    /**
     * @param mixed $data
     */
    public function __construct(mixed $data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return TwitchResponse
     */
    public function setData(mixed $data): TwitchResponse
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

    /**
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @param int|null $total
     *
     * @return TwitchResponse
     */
    public function setTotal(?int $total): TwitchResponse
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string|null $template
     *
     * @return TwitchResponse
     */
    public function setTemplate(?string $template): TwitchResponse
    {
        $this->template = $template;

        return $this;
    }
}
