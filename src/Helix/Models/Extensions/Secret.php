<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Extensions;

final readonly class Secret
{
    /**
     * @param string             $content   The raw secret that you use with JWT encoding.
     * @param \DateTimeImmutable $activeAt  The UTC date and time (in RFC3339 format) that you may begin using this secret to sign a JWT.
     * @param \DateTimeImmutable $expiresAt The UTC date and time (in RFC3339 format) that you must stop using this secret to decode a JWT.
     */
    public function __construct(
        private string $content,
        private \DateTimeImmutable $activeAt,
        private \DateTimeImmutable $expiresAt
    ) {
    }

    public function getContent(): string {
        return $this->content;
    }

    public function getActiveAt(): \DateTimeImmutable {
        return $this->activeAt;
    }

    public function getExpiresAt(): \DateTimeImmutable {
        return $this->expiresAt;
    }
}
