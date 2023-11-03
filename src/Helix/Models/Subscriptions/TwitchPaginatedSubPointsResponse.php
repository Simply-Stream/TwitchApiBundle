<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Subscriptions;

use SimplyStream\TwitchApiBundle\Helix\Models\Pagination;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchPaginatedDataResponse;

/**
 * @template T
 */
readonly class TwitchPaginatedSubPointsResponse extends TwitchPaginatedDataResponse
{
    /**
     * @param T          $data
     * @param Pagination $pagination
     * @param int        $points The current number of subscriber points earned by this broadcaster. Points are based on the subscription
     *                           tier of each user that subscribes to this broadcaster. For example, a Tier 1 subscription is worth 1
     *                           point, Tier 2 is worth 2 points, and Tier 3 is worth 6 points. The number of points determines the number
     *                           of emote slots that are unlocked for the broadcaster (see Subscriber Emote Slots).
     * @param int|null   $total
     */
    public function __construct(
        mixed $data,
        Pagination $pagination,
        private int $points,
        ?int $total = null
    ) {
        parent::__construct($data, $this->pagination, $this->total);
    }

    public function getPoints(): int {
        return $this->points;
    }
}
