<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

final readonly class ExtensionBitsProduct
{
    /**
     * @param string              $sku           The product’s SKU. The SKU is unique across an extension’s products.
     * @param ExtensionBitsAmount $cost          An object that contains the product’s cost information.
     * @param bool                $inDevelopment A Boolean value that indicates whether the product is in development. If true, the product
     *                                           is not available for public use.
     * @param string              $displayName   The product’s name as displayed in the extension.
     * @param \DateTimeImmutable  $expiration    The date and time, in RFC3339 format, when the product expires.
     * @param bool                $isBroadcast   A Boolean value that determines whether Bits product purchase events are broadcast to all
     *                                           instances of an extension on a channel. The events are broadcast via the
     *                                           onTransactionComplete helper callback. Is true if the event is broadcast to all instances.
     */
    public function __construct(
        private string $sku,
        private ExtensionBitsAmount $cost,
        private bool $inDevelopment,
        private string $displayName,
        private \DateTimeImmutable $expiration,
        private bool $isBroadcast
    ) {
    }

    public function getSku(): string {
        return $this->sku;
    }

    public function getCost(): ExtensionBitsAmount {
        return $this->cost;
    }

    public function isInDevelopment(): bool {
        return $this->inDevelopment;
    }

    public function getDisplayName(): string {
        return $this->displayName;
    }

    public function getExpiration(): \DateTimeImmutable {
        return $this->expiration;
    }

    public function isBroadcast(): bool {
        return $this->isBroadcast;
    }
}
