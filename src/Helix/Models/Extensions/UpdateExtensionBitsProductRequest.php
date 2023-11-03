<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

use Webmozart\Assert\Assert;

final readonly class UpdateExtensionBitsProductRequest
{
    /**
     * @param string                  $sku           The product’s SKU. The SKU must be unique within an extension. The product’s SKU
     *                                               cannot be changed. The SKU may contain only alphanumeric characters, dashes (-),
     *                                               underscores (_), and periods (.) and is limited to a maximum of 255 characters. No
     *                                               spaces.
     * @param ExtensionBitsAmount     $cost          An object that contains the product’s cost information.
     * @param string                  $displayName   The product’s name as displayed in the extension. The maximum length is 255
     *                                               characters.
     * @param bool                    $inDevelopment A Boolean value that indicates whether the product is in development. Set to true if
     *                                               the product is in development and not available for public use. The default is false.
     * @param \DateTimeImmutable|null $expiration    The date and time, in RFC3339 format, when the product expires. If not set, the
     *                                               product does not expire. To disable the product, set the expiration date to a date in
     *                                               the past.
     * @param bool                    $isBroadcast   A Boolean value that determines whether Bits product purchase events are broadcast to
     *                                               all instances of the extension on a channel. The events are broadcast via the
     *                                               onTransactionComplete helper callback. The default is false.
     */
    public function __construct(
        private string $sku,
        private ExtensionBitsAmount $cost,
        private string $displayName,
        private bool $inDevelopment = false,
        private ?\DateTimeImmutable $expiration = null,
        private bool $isBroadcast = false
    ) {
        Assert::maxLength($this->displayName, 255, 'The maximum length of a display name is 255');
    }

    public function getSku(): string {
        return $this->sku;
    }

    public function getCost(): ExtensionBitsAmount {
        return $this->cost;
    }

    public function getDisplayName(): string {
        return $this->displayName;
    }

    public function isInDevelopment(): bool {
        return $this->inDevelopment;
    }

    public function getExpiration(): ?\DateTimeImmutable {
        return $this->expiration;
    }

    public function isBroadcast(): bool {
        return $this->isBroadcast;
    }
}
