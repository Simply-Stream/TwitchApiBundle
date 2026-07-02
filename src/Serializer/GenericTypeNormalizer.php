<?php

declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Serializer;

use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class GenericTypeNormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return str_contains($type, '<');
    }

    public function getSupportedTypes(?string $format): array
    {
        return ['*' => false];
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        preg_match('/^(.+)<(.+)>$/', $type, $matches);

        $outerClass = $matches[1];
        $innerType = $matches[2];

        $data['data'] = $this->denormalizer->denormalize($data['data'], $innerType, $format, $context);

        return $this->denormalizer->denormalize($data, $outerClass, $format, $context);
    }
}
