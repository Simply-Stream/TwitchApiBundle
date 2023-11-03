<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Bits;

final readonly class ProductData
{
    /**
     * @param string $sku           An ID that identifies the digital product.
     * @param string $domain        Set to twitch.ext. + <the extension's ID>.
     * @param array  $cost          Contains details about the digital product’s cost.
     * @param bool   $inDevelopment A Boolean value that determines whether the product is in development. Is true if the digital product
     *                              is in development and cannot be exchanged.
     * @param string $displayName   The name of the digital product.
     * @param string $expiration    This field is always empty since you may purchase only unexpired products.
     * @param bool   $broadcast     A Boolean value that determines whether the data was broadcast to all instances of the extension. Is
     *                              true if the data was broadcast to all instances.
     */
    public function __construct(
        private string $sku,
        private string $domain,
        private array $cost,
        private bool $inDevelopment,
        private string $displayName,
        private string $expiration,
        private bool $broadcast
    ) {
    }

    public function getSku(): string {
        return $this->sku;
    }

    public function getDomain(): string {
        return $this->domain;
    }

    public function getCost(): array {
        return $this->cost;
    }

    public function isInDevelopment(): bool {
        return $this->inDevelopment;
    }

    public function getDisplayName(): string {
        return $this->displayName;
    }

    public function getExpiration(): string {
        return $this->expiration;
    }

    public function isBroadcast(): bool {
        return $this->broadcast;
    }
}
