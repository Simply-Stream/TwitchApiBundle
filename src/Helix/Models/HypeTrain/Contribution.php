<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\HypeTrain;

final readonly class Contribution
{
    /**
     * @param int    $total The total amount contributed. If type is BITS, total represents the amount of Bits used. If type is SUBS, total
     *                      is 500, 1000, or 2500 to represent tier 1, 2, or 3 subscriptions, respectively.
     * @param string $type  The contribution method used. Possible values are:
     *                      - BITS — Cheering with Bits.
     *                      - SUBS — Subscription activity like subscribing or gifting subscriptions.
     *                      - OTHER — Covers other contribution methods not listed.
     * @param string $user  The ID of the user that made the contribution.
     */
    public function __construct(
        private int $total,
        private string $type,
        private string $user
    ) {
    }

    public function getTotal(): int {
        return $this->total;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getUser(): string {
        return $this->user;
    }
}
