<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Product
{
    use SerializesModels;

    /**
     * @param string $name          Product name.
     * @param int    $bits          Bits involved in the transaction.
     * @param string $sku           Unique identifier for the product acquired.
     * @param bool   $inDevelopment Flag indicating if the product is in development. If in_development is true, bits will be 0.
     */
    public function __construct(
        private string $name,
        private int $bits,
        private string $sku,
        private bool $inDevelopment
    ) {
    }

    public function getName(): string {
        return $this->name;
    }

    public function getBits(): int {
        return $this->bits;
    }

    public function getSku(): string {
        return $this->sku;
    }

    public function isInDevelopment(): bool {
        return $this->inDevelopment;
    }
}
