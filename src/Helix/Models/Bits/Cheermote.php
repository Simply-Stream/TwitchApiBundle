<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Bits;

final readonly class Cheermote
{
    /**
     * @param string             $prefix       The name portion of the Cheermote string that you use in chat to cheer Bits. The full
     *                                         Cheermote string is the concatenation of {prefix} + {number of Bits}. For example, if the
     *                                         prefix is “Cheer” and you want to cheer 100 Bits, the full Cheermote string is Cheer100.
     *                                         When the Cheermote string is entered in chat, Twitch converts it to the image associated
     *                                         with the Bits tier that was cheered.
     * @param Tier[]             $tiers        A list of tier levels that the Cheermote supports. Each tier identifies the range of Bits
     *                                         that you can cheer at that tier level and an image that graphically identifies the tier
     *                                         level.
     * @param string             $type         The type of Cheermote. Possible values are:
     *                                         - global_first_party — A Twitch-defined Cheermote that is shown in the Bits card.
     *                                         - global_third_party — A Twitch-defined Cheermote that is not shown in the Bits card.
     *                                         - channel_custom — A broadcaster-defined Cheermote.
     *                                         - display_only — Do not use; for internal use only.
     *                                         - sponsored — A sponsor-defined Cheermote. When used, the sponsor adds additional Bits to
     *                                         the amount that the user cheered. For example, if the user cheered Terminator100, the
     *                                         broadcaster might receive 110 Bits, which includes the sponsor's 10 Bits contribution.
     * @param int                $order        The order that the Cheermotes are shown in the Bits card. The numbers may not be
     *                                         consecutive. For example, the numbers may jump from 1 to 7 to 13. The order numbers are
     *                                         unique within a Cheermote type (for example, global_first_party) but may not be unique
     *                                         amongst all Cheermotes in the response.
     * @param \DateTimeImmutable $lastUpdated  The date and time, in RFC3339 format, when this Cheermote was last updated.
     * @param bool               $isCharitable A Boolean value that indicates whether this Cheermote provides a charitable contribution
     *                                         match during charity campaigns.
     */
    public function __construct(
        private string $prefix,
        private array $tiers,
        private string $type,
        private int $order,
        private \DateTimeImmutable $lastUpdated,
        private bool $isCharitable
    ) {
    }

    public function getPrefix(): string {
        return $this->prefix;
    }

    public function getTiers(): array {
        return $this->tiers;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getOrder(): int {
        return $this->order;
    }

    public function getLastUpdated(): \DateTimeImmutable {
        return $this->lastUpdated;
    }

    public function isCharitable(): bool {
        return $this->isCharitable;
    }
}
