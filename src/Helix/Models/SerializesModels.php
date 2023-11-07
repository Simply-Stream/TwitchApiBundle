<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models;

use ReflectionClass;

trait SerializesModels
{
    /**
     * @throws \ReflectionException
     */
    public function toArray(): array {
        return $this->convert($this);
    }

    /**
     * @throws \ReflectionException
     */
    private function convert($object) {
        if (is_object($object)) {
            $reflection = new ReflectionClass($object);
            $properties = $reflection->getProperties();
            $array = [];

            foreach ($properties as $property) {
                $value = $property->getValue($object);

                if (is_object($value) && method_exists($value, 'toArray')) {
                    $array[strtolower(ltrim(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $property->getName()), '_'))] = self::convert($value);
                } else {
                    $array[strtolower(ltrim(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $property->getName()), '_'))] = $value;
                }
            }

            return $array;
        }

        return $object;
    }
}
