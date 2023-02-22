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
interface ConditionInterface
{
    public const AUTH_TYPE_APP = 'app';
    public const AUTH_TYPE_USER = 'user';
    /**
     * Returns the type for a condition
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Returns the options required by condition
     *
     * @return array
     */
    public function getRequiredOptions(): array;
}
