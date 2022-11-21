<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

class Product
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $bits;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var bool
     */
    protected $development;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getBits(): int
    {
        return $this->bits;
    }

    /**
     * @param int $bits
     *
     * @return $this
     */
    public function setBits(int $bits): self
    {
        $this->bits = $bits;

        return $this;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     *
     * @return $this
     */
    public function setSku(string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDevelopment(): bool
    {
        return $this->development;
    }

    /**
     * @param bool $development
     *
     * @return $this
     */
    public function setDevelopment(bool $development): self
    {
        $this->development = $development;

        return $this;
    }
}
