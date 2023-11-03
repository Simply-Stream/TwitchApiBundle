<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Channels;

final readonly class ChannelEditor
{
    /**
     * @param string             $userId    An ID that uniquely identifies a user with editor permissions.
     * @param string             $userName  The user’s display name.
     * @param \DateTimeImmutable $createdAt The date and time, in RFC3339 format, when the user became one of the broadcaster’s editors.
     */
    public function __construct(
        private string $userId,
        private string $userName,
        private \DateTimeImmutable $createdAt
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }
}
