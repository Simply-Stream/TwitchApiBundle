<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class DropEntitlementGrantCondition implements ConditionInterface
{
    use SerializesModels;

    public function __construct(
        private string $organizationId,
        private string $categoryId,
        private string $campaignId
    ) {
    }

    public function getOrganizationId(): string {
        return $this->organizationId;
    }

    public function getCategoryId(): string {
        return $this->categoryId;
    }

    public function getCampaignId(): string {
        return $this->campaignId;
    }
}
