<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\ChannelPoints;

final readonly class MaxPerUserPerStreamSetting
{
    /**
     * @param bool $isEnabled           A Boolean value that determines whether the reward applies a limit on the number of redemptions
     *                                  allowed per user per live stream. Is true if the reward applies a limit.
     * @param int  $maxPerUserPerStream The maximum number of redemptions allowed per user per live stream.
     */
    public function __construct(
        private bool $isEnabled,
        private int $maxPerUserPerStream
    ) {
    }

    public function isEnabled(): bool {
        return $this->isEnabled;
    }

    public function getMaxPerUserPerStream(): int {
        return $this->maxPerUserPerStream;
    }
}
