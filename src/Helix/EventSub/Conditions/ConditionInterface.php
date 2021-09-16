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
