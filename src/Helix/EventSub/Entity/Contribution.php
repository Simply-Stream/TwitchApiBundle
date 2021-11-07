<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events\HasUser;

class Contribution
{
    use HasUser;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $total;

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
