<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Factories;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions\Conditions;

class ConditionFactory
{
    /**
     * @param string $type
     * @param array  $options
     *
     * @return mixed
     */
    public static function createFromType(string $type, array $options = [])
    {
        $conditionType = Conditions::CONDITIONS[$type];

        return new $conditionType($options);
    }
}
