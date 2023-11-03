<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Entitlements;

final readonly class DropEntitlementUpdate
{
    /**
     * @param string   $status A string that indicates whether the status of the entitlements in the ids field were successfully updated.
     *                         Possible values are:
     *                         - INVALID_ID — The entitlement IDs in the ids field are not valid.
     *                         - NOT_FOUND — The entitlement IDs in the ids field were not found.
     *                         - SUCCESS — The status of the entitlements in the ids field were successfully updated.
     *                         - UNAUTHORIZED — The user or organization identified by the user access token is not authorized to update the
     *                         entitlements.
     *                         - UPDATE_FAILED — The update failed. These are considered transient errors and the request should be retried
     *                         later.
     * @param string[] $ids    The list of entitlements that the status in the status field applies to.
     */
    public function __construct(
        private string $status,
        private array $ids
    ) {
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getIds(): array {
        return $this->ids;
    }
}
