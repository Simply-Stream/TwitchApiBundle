<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Bits;

final readonly class Tier
{
    /**
     * @param int    $minBits        The minimum number of Bits that you must cheer at this tier level. The maximum number of Bits that you
     *                               can cheer at this level is determined by the required minimum Bits of the next tier level minus 1. For
     *                               example, if min_bits is 1 and min_bits for the next tier is 100, the Bits range for this tier level is
     *                               1 through 99. The minimum Bits value of the last tier is the maximum number of Bits you can cheer
     *                               using this Cheermote. For example, 10000.
     * @param string $id             The tier level. Possible tiers are:
     *                               - 1
     *                               - 100
     *                               - 500
     *                               - 1000
     *                               - 5000
     *                               - 10000
     *                               - 100000
     * @param string $color          The hex code of the color associated with this tier level (for example, #979797).
     * @param array  $images         The animated and static image sets for the Cheermote. The dictionary of images is organized by theme,
     *                               format, and size. The theme keys are dark and light. Each theme is a dictionary of formats: animated
     *                               and static. Each format is a dictionary of sizes: 1, 1.5, 2, 3, and 4. The value of each size contains
     *                               the URL to the image.
     * @param bool   $canCheer       A Boolean value that determines whether users can cheer at this tier level.
     * @param bool   $showInBitsCard A Boolean value that determines whether this tier level is shown in the Bits card. Is true if this
     *                               tier level is shown in the Bits card.
     */
    public function __construct(
        private int $minBits,
        private string $id,
        private string $color,
        private array $images,
        private bool $canCheer,
        private bool $showInBitsCard
    ) {
    }

    public function getMinBits(): int {
        return $this->minBits;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function getImages(): array {
        return $this->images;
    }

    public function isCanCheer(): bool {
        return $this->canCheer;
    }

    public function isShowInBitsCard(): bool {
        return $this->showInBitsCard;
    }
}
