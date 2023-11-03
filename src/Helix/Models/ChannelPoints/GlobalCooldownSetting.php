<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\ChannelPoints;

final readonly class GlobalCooldownSetting
{
    /**
     * @param bool $isEnabled             A Boolean value that determines whether to apply a cooldown period. Is true if a cooldown period
     *                                    is enabled.
     * @param int  $globalCooldownSeconds The cooldown period, in seconds.
     */
    public function __construct(
        private bool $isEnabled,
        private int $globalCooldownSeconds,
    ) {
    }

    public function isEnabled(): bool {
        return $this->isEnabled;
    }

    public function getGlobalCooldownSeconds(): int {
        return $this->globalCooldownSeconds;
    }
}
