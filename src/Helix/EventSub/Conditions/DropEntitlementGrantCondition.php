<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions
 */
class DropEntitlementGrantCondition extends AbstractCondition
{
    public const TYPE = 'drop.entitlement.grant';

    protected $requiredOptions = [
        'organizationId',
    ];

    /**
     * @var string
     */
    protected $organizationId;

    /**
     * @var string
     */
    protected $categoryId;

    /**
     * @var string
     */
    protected $campaignId;

    /**
     * @return string
     */
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getCampaignId(): string
    {
        return $this->campaignId;
    }
}
