<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events\HasUser;

class Contribution
{
    use HasUser;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var int
     */
    protected int $total;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     *
     * @return $this
     */
    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }
}
