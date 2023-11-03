<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Streams;

final readonly class StreamKey
{
    /**
     * @param string $streamKey The channel’s stream key.
     */
    public function __construct(
        private string $streamKey
    ) {
    }

    public function getStreamKey(): string {
        return $this->streamKey;
    }
}
