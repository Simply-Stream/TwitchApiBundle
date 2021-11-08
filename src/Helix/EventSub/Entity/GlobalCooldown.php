<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity;

class GlobalCooldown
{
    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var int
     */
    protected $seconds;

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
    public function getSeconds(): int
    {
        return $this->seconds;
    }

    /**
     * @param int $seconds
     *
     * @return $this
     */
    public function setSeconds(int $seconds): self
    {
        $this->seconds = $seconds;

        return $this;
    }
}
