<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Announcement
{
    use SerializesModels;

    /**
     * @param string $color Color of the announcement.
     */
    public function __construct(
        private string $color
    ) {
    }

    public function getColor(): string {
        return $this->color;
    }
}
