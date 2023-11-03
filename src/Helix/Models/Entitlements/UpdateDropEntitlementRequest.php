<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Entitlements;

use Webmozart\Assert\Assert;

final readonly class UpdateDropEntitlementRequest
{
    /**
     * @param string[]    $entitlementIds   A list of IDs that identify the entitlements to update. You may specify a maximum of 100 IDs.
     * @param string|null $fulfilmentStatus The fulfillment status to set the entitlements to. Possible values are:
     *                                      - CLAIMED — The user claimed the benefit.
     *                                      - FULFILLED — The developer granted the benefit that the user claimed.
     */
    public function __construct(
        private array $entitlementIds = [],
        private ?string $fulfilmentStatus = null
    ) {
        if (null !== $this->fulfilmentStatus) {
            Assert::inArray($this->fulfilmentStatus, ['CLAIMED', 'FULFILLED'], 'Fulfilment status got an invalid value. Allowed values are: CLAIMED, FULFILLED');
        }

        Assert::allString($this->entitlementIds, 'Only strings are allowed as entitlement ID');
        Assert::maxCount($this->entitlementIds, 100, 'You may specify a maximum of 100 entitlement IDs');
    }

    public function getEntitlementIds(): array {
        return $this->entitlementIds;
    }

    public function getFulfilmentStatus(): ?string {
        return $this->fulfilmentStatus;
    }
}
