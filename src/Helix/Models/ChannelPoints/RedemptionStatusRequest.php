<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\ChannelPoints;

use Webmozart\Assert\Assert;

final readonly class RedemptionStatusRequest
{
    /**
     * @param string $status The status to set the redemption to. Possible values are:
     *                       - CANCELED
     *                       - FULFILLED
     *                       Setting the status to CANCELED refunds the user’s channel points.
     */
    public function __construct(
        private string $status
    ) {
        Assert::inArray($this->status, ['CANCELED', 'FULFILLED']);
    }

    public function getStatus(): string {
        return $this->status;
    }
}
