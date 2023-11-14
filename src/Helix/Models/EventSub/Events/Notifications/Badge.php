<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Badge
{
    use SerializesModels;

    /**
     * @param string $setId An ID that identifies this set of chat badges. For example, Bits or Subscriber.
     * @param string $id    An ID that identifies this version of the badge. The ID can be any value. For example, for Bits, the ID is the
     *                      Bits tier level, but for World of Warcraft, it could be Alliance or Horde.
     * @param string $info  Contains metadata related to the chat badges in the badges tag. Currently, this tag contains metadata only for
     *                      subscriber badges, to indicate the number of months the user has been a subscriber.
     */
    public function __construct(
        private string $setId,
        private string $id,
        private string $info
    ) {
    }

    public function getSetId(): string {
        return $this->setId;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getInfo(): string {
        return $this->info;
    }
}
