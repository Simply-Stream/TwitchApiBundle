<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Entitlements;

final readonly class DropEntitlement
{
    /**
     * @param string             $id               An ID that identifies the entitlement.
     * @param string             $benefitId        An ID that identifies the benefit (reward).
     * @param \DateTimeImmutable $timestamp        The UTC date and time (in RFC3339 format) of when the entitlement was granted.
     * @param string             $userId           An ID that identifies the user who was granted the entitlement.
     * @param string             $gameId           An ID that identifies the game the user was playing when the reward was entitled.
     * @param string             $fulfilmentStatus The entitlement’s fulfillment status. Possible values are:
     *                                             - CLAIMED
     *                                             - FULFILLED
     * @param \DateTimeImmutable $lastUpdated      The UTC date and time (in RFC3339 format) of when the entitlement was last updated.
     */
    public function __construct(
        string $id,
        string $benefitId,
        \DateTimeImmutable $timestamp,
        string $userId,
        string $gameId,
        string $fulfilmentStatus,
        \DateTimeImmutable $lastUpdated
    ) {
    }
}
