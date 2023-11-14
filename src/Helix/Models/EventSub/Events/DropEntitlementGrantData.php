<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class DropEntitlementGrantData
{
    use SerializesModels;

    /**
     * @param string             $organizationId The ID of the organization that owns the game that has Drops enabled.
     * @param string             $categoryId     Twitch category ID of the game that was being played when this benefit was entitled.
     * @param string             $categoryName   The category name.
     * @param string             $campaignId     The campaign this entitlement is associated with.
     * @param string             $userId         Twitch user ID of the user who was granted the entitlement.
     * @param string             $userName       The user display name of the user who was granted the entitlement.
     * @param string             $userLogin      The user login of the user who was granted the entitlement.
     * @param string             $entitlementId  Unique identifier of the entitlement. Use this to de-duplicate entitlements.
     * @param string             $benefitId      Identifier of the Benefit.
     * @param \DateTimeImmutable $createdAt      UTC timestamp in ISO format when this entitlement was granted on Twitch.
     */
    public function __construct(
        private string $organizationId,
        private string $categoryId,
        private string $categoryName,
        private string $campaignId,
        private string $userId,
        private string $userName,
        private string $userLogin,
        private string $entitlementId,
        private string $benefitId,
        private \DateTimeImmutable $createdAt
    ) {
    }

    public function getOrganizationId(): string {
        return $this->organizationId;
    }

    public function getCategoryId(): string {
        return $this->categoryId;
    }

    public function getCategoryName(): string {
        return $this->categoryName;
    }

    public function getCampaignId(): string {
        return $this->campaignId;
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getEntitlementId(): string {
        return $this->entitlementId;
    }

    public function getBenefitId(): string {
        return $this->benefitId;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }
}
