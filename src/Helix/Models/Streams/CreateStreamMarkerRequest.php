<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Streams;

use Webmozart\Assert\Assert;

final readonly class CreateStreamMarkerRequest
{
    /**
     * @param string $userId      The ID of the broadcaster that’s streaming content. This ID must match the user ID in the access token or
     *                            the user in the access token must be one of the broadcaster’s editors.
     * @param string $description A short description of the marker to help the user remember why they marked the location. The maximum
     *                            length of the description is 140 characters.
     */
    public function __construct(
        private string $userId,
        private string $description
    ) {
        if (null !== $this->description) {
            Assert::maxLength(
                $this->description,
                140,
                sprintf('The maximum length for a description is 140 characters, %s given', strlen($this->description))
            );
        }
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getDescription(): string {
        return $this->description;
    }
}
