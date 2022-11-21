<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

class GlobalCooldown
{
    /**
     * @var bool
     */
    protected bool $isEnabled;

    /**
     * @var int
     */
    protected int $seconds;

    /**
     * @return bool
     */
    public function isIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

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
