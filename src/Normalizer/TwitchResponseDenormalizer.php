<?php

namespace SimplyStream\TwitchApiBundle\Normalizer;

use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponse;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TwitchResponseDenormalizer extends ObjectNormalizer implements DenormalizerInterface
{
    public const DENORMALIZER_CONTEXT_DATA_TYPE = 'data_type';

    /**
     * @param             $data
     * @param string      $type
     * @param string|null $format
     * @param array       $context
     *
     * @return bool
     */
    public function supportsDenormalization($data, string $type, string $format = null, array $context = []): bool
    {
        return $type === TwitchResponse::class;
    }

    /**
     * @param             $data
     * @param string      $type
     * @param string|null $format
     * @param array       $context
     *
     * @return mixed
     * @throws ExceptionInterface
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): mixed
    {
        /** @var TwitchResponse $denormalizedResponse */
        $denormalizedResponse = parent::denormalize($data, $type, $format, $context);

        if (isset($context[self::DENORMALIZER_CONTEXT_DATA_TYPE])) {
            $denormalizedData = [];

            foreach ($denormalizedResponse->getData() as $value) {
                $denormalizedData[] = parent::denormalize($value, $context[self::DENORMALIZER_CONTEXT_DATA_TYPE], 'json');
            }

            $denormalizedResponse->setData($denormalizedData);
        }

        return $denormalizedResponse;
    }
}
