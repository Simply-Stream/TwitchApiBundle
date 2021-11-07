<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity;

class MaxPerStream
{
    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var int
     */
    protected $value;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     *
     * @return $this
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}
