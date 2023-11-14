<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Cheermote
{
    use SerializesModels;

    /**
     * @param string $prefix The name portion of the Cheermote string that you use in chat to cheer Bits. The full Cheermote string is the
     *                       concatenation of {prefix} + {number of Bits}. For example, if the prefix is “Cheer” and you want to cheer 100
     *                       Bits, the full Cheermote string is Cheer100. When the Cheermote string is entered in chat, Twitch converts it
     *                       to the image associated with the Bits tier that was cheered.
     * @param int    $bits   The amount of bits cheered.
     * @param int    $tier   The tier level of the cheermote.
     */
    public function __construct(
        private string $prefix,
        private int $bits,
        private int $tier
    ) {
    }

    public function getPrefix(): string {
        return $this->prefix;
    }

    public function getBits(): int {
        return $this->bits;
    }

    public function getTier(): int {
        return $this->tier;
    }
}
