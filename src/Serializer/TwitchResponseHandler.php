<?php

namespace SimplyStream\TwitchApiBundle\Serializer;

use JMS\Serializer\Accessor\AccessorStrategyInterface;
use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\Context;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Exception\InvalidArgumentException;
use JMS\Serializer\Exception\NotAcceptableException;
use JMS\Serializer\Exception\UninitializedPropertyException;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\SerializationContext;

class TwitchResponseHandler
{
    public function __construct(
        protected ObjectConstructorInterface $objectConstructor,
        protected AccessorStrategyInterface $accessor,
    ) {
    }

    public function deserializeTwitchResponseFromjson(
        JsonDeserializationVisitor $visitor,
        $response,
        array $type,
        DeserializationContext $context
    ) {
        $metadata = $context->getMetadataFactory()->getMetadataForClass($type['name']);
        \assert($metadata instanceof ClassMetadata);

        $context->pushClassMetadata($metadata);
        $context->increaseDepth();
        $object = $this->objectConstructor->construct($visitor, $metadata, $response, $type, $context);

        if (null === $object) {
            $context->popClassMetadata();
            $context->decreaseDepth();

            return $visitor->visitNull($response, $type);
        }

        $visitor->startVisitingObject($metadata, $object, $type);
        foreach ($metadata->propertyMetadata as $propertyMetadata) {
            if ($propertyMetadata->readOnly) {
                continue;
            }

            $oldMetadataType = null;
            if (isset($propertyMetadata->type['name'])) {
                $oldMetadataType = $propertyMetadata->type;
            }

            // @TODO: Make this more dynamic, maybe check out the @template phpdoc to beautify this
            if (isset($propertyMetadata->type['name']) && ($propertyMetadata->type['name'] === 'T' || $propertyMetadata->type['name'] ===
                    'T1') && count($type['params']) === 1) {
                $propertyMetadata->setType($type['params'][0]);
            }

            if (isset($propertyMetadata->type['name']) && $propertyMetadata->type['name'] === 'T2' && count($type['params']) > 1) {
                $propertyMetadata->setType($type['params'][1]);
            }

            if (isset($propertyMetadata->type['params']) && count($propertyMetadata->type['params']) > 0 && ($propertyMetadata->type['params'][0]['name'] === 'T' || $propertyMetadata->type['params'][0]['name'] === 'T1')) {
                $propertyMetadata->type['params'][0]['name'] = $type['params'][0]['name'];
            }

            if (isset($propertyMetadata->type['params']) && count($propertyMetadata->type['params']) > 0 && $propertyMetadata->type['params'][0]['name'] === 'T2') {
                $propertyMetadata->type['params'][0]['name'] = $type['params'][1]['name'];
            }

            // Twitch will send a date that is not supported by PHP, so we crop off the nanoseconds
            if (\DateTime::class === $propertyMetadata->type['name']) {
                $response[$propertyMetadata->serializedName] = preg_replace(
                    "/^((?:(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2}:\d{2})((?:\.\d+)?))(Z|[\+-]\d{2}:\d{2})?)$/",
                    '$2T$3$5',
                    $response[$propertyMetadata->serializedName]
                );
            }

            $context->pushPropertyMetadata($propertyMetadata);
            try {
                $v = $visitor->visitProperty($propertyMetadata, $response);
                $this->accessor->setValue($object, $v, $propertyMetadata, $context);
            } catch (NotAcceptableException $e) {
                if (true === $propertyMetadata->hasDefault) {
                    $this->accessor->setValue($object, $propertyMetadata->defaultValue, $propertyMetadata, $context);
                }
            }

            $context->popPropertyMetadata();

            if ($oldMetadataType) {
                $propertyMetadata->setType($oldMetadataType);
            }
        }

        $rs = $visitor->endVisitingObject($metadata, $response, $type);
        $this->afterVisitingObject($context);

        return $rs;
    }

    public function serializeTwitchResponseToArray(
        JsonSerializationVisitor $visitor,
        $data,
        array $type,
        SerializationContext $context
    ) {
        $metadata = $context->getMetadataFactory()->getMetadataForClass($type['name']);
        \assert($metadata instanceof ClassMetadata);

        if (! is_object($data)) {
            throw new InvalidArgumentException('Value at ' . $context->getPath() . ' is expected to be an object of class ' . $type['name'] . ' but is of type ' . gettype($data));
        }

        $context->pushClassMetadata($metadata);

        foreach ($metadata->preSerializeMethods as $method) {
            $method->invoke($data);
        }

        $visitor->startVisitingObject($metadata, $data, $type);
        foreach ($metadata->propertyMetadata as $propertyMetadata) {
            $oldMetadataType = null;
            if (isset($propertyMetadata->type['name'])) {
                $oldMetadataType = $propertyMetadata->type;
            }

            // @TODO: Make this more dynamic, maybe check out the @template phpdoc to beautify this
            if (isset($propertyMetadata->type['name']) && ($propertyMetadata->type['name'] === 'T' || $propertyMetadata->type['name'] ===
                    'T1') && count($type['params']) === 1) {
                $propertyMetadata->setType($type['params'][0]);
            }

            if (isset($propertyMetadata->type['name']) && $propertyMetadata->type['name'] === 'T2' && count($type['params']) > 1) {
                $propertyMetadata->setType($type['params'][1]);
            }

            if (isset($propertyMetadata->type['params']) && count($propertyMetadata->type['params']) > 0 && ($propertyMetadata->type['params'][0]['name'] === 'T' || $propertyMetadata->type['params'][0]['name'] === 'T1')) {
                $propertyMetadata->type['params'][0]['name'] = $type['params'][0]['name'];
            }

            if (isset($propertyMetadata->type['params']) && count($propertyMetadata->type['params']) > 0 && $propertyMetadata->type['params'][0]['name'] === 'T2') {
                $propertyMetadata->type['params'][0]['name'] = $type['params'][1]['name'];
            }

            try {
                $v = $this->accessor->getValue($data, $propertyMetadata, $context);
            } catch (UninitializedPropertyException $e) {
                continue;
            }

            $context->pushPropertyMetadata($propertyMetadata);
            $visitor->visitProperty($propertyMetadata, $v);
            $context->popPropertyMetadata();

            if ($oldMetadataType) {
                $propertyMetadata->setType($oldMetadataType);
            }
        }

        if ($context->getDepth() > 1) {
            $this->afterVisitingObjectSerialize($metadata, $data, $type, $context);
        }

        return $visitor->endVisitingObject($metadata, $data, $type);
    }

    private function afterVisitingObjectSerialize(ClassMetadata $metadata, object $object, array $type, Context $context): void
    {
        $context->stopVisiting($object);
        $context->popClassMetadata();

        foreach ($metadata->postSerializeMethods as $method) {
            $method->invoke($object);
        }
    }

    private function afterVisitingObject(Context $context): void
    {
        $context->decreaseDepth();
        $context->popClassMetadata();
    }
}
