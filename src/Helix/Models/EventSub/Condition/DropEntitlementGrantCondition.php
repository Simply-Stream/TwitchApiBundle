<?php declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

final readonly class DropEntitlementGrantCondition implements ConditionInterface
{
    public const TYPE = 'drop.entitlement.grant';

    public function __construct(
        private string $organizationId,
        private string $categoryId,
        private string $campaignId
    ) {
    }

    public static function getType(): string {
        return self::TYPE;
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
