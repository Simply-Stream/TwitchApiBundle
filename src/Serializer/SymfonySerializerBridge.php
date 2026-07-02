<?php

declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Serializer;

use SimplyStream\TwitchApi\Shared\Serializer\SerializerInterface;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class SymfonySerializerBridge implements SerializerInterface
{
    public function __construct(
        private readonly SymfonySerializerInterface $serializer,
    ) {
    }

    public function serialize(mixed $data, string $format): string
    {
        return $this->serializer->serialize($data, $format);
    }

    public function deserialize(mixed $data, string $type, string $format): mixed
    {
        return $this->serializer->deserialize($data, $type, $format);
    }
}
