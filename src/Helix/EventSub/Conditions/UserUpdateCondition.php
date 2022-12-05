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
class UserUpdateCondition extends AbstractCondition
{
    public const TYPE = 'user.update';

    protected array $requiredOptions = [
        'userId',
    ];

    /**
     * @var string
     */
    protected string $userId;

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }
}
