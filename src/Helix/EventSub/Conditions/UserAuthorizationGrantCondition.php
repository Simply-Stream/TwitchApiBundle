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
class UserAuthorizationGrantCondition extends AbstractCondition
{
    public const TYPE = 'user.authorization.grant';

    /**
     * @inheritdoc
     */
    protected $requiredOptions = [
        'clientId',
    ];

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }
}
