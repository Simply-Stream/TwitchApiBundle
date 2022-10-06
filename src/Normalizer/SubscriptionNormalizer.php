<?php

namespace SimplyStream\TwitchApiBundle\Normalizer;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Factories\ConditionFactory;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SubscriptionNormalizer extends ObjectNormalizer implements NormalizerInterface
{
    /**
     * Overrides and reuses internal method denormalizeParameter to properly denormalize "condition"
     *
     * @param \ReflectionClass     $class
     * @param \ReflectionParameter $parameter
     * @param string               $parameterName
     * @param mixed                $parameterData
     * @param array                $context
     * @param string|null          $format
     *
     * @return array|array[]|bool|bool[]|float|int|int[]|mixed|string|string[]|null
     */
    protected function denormalizeParameter(
        \ReflectionClass $class,
        \ReflectionParameter $parameter,
        string $parameterName,
        mixed $parameterData,
        array $context,
        string $format = null
    ): mixed {
        if ($parameterName === 'condition') {
            $options = [];
            array_walk($parameterData, function ($value, $key) use (&$options) {
                $options[$this->nameConverter->denormalize($key)] = $value;
            });

            return ConditionFactory::createFromType($context['eventsub.eventType'], $options);
        }

        return parent::denormalizeParameter($class, $parameter, $parameterName, $parameterData, $context, $format);
    }
}
