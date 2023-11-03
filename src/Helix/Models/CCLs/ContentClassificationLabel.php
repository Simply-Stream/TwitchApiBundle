<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\CCLs;

final readonly class ContentClassificationLabel
{
    /**
     * @param Label[] $contentClassificationLabels
     */
    public function __construct(
        private array $contentClassificationLabels
    ) {
    }

    public function getContentClassificationLabels(): array {
        return $this->contentClassificationLabels;
    }
}
