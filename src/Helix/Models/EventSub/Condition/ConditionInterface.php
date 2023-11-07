<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Condition;

interface ConditionInterface
{
    public static function getType(): string;
}
