<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class PrimePaidUpgrade
{
    use SerializesModels;

    /**
     * @param string $subTier The type of subscription plan being used. Possible values are:
     *                        - 1000 — First level of paid subscription
     *                        - 2000 — Second level of paid subscription
     *                        - 3000 — Third level of paid subscription
     */
    public function __construct(
        private string $subTier
    ) {
    }

    public function getSubTier(): string {
        return $this->subTier;
    }
}
