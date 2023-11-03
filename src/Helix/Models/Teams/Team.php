<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Teams;

final readonly class Team
{
    /**
     * @param string             $broadcasterId      An ID that identifies the broadcaster.
     * @param string             $broadcasterLogin   The broadcaster’s login name.
     * @param string             $broadcasterName    The broadcaster’s display name.
     * @param string             $backgroundImageUrl A URL to the team’s background image.
     * @param string             $banner             A URL to the team’s banner.
     * @param \DateTimeImmutable $createdAt          The UTC date and time (in RFC3339 format) of when the team was created.
     * @param \DateTimeImmutable $updatedAt          The UTC date and time (in RFC3339 format) of the last time the team was updated.
     * @param string             $info               The team’s description. The description may contain formatting such as Markdown, HTML,
     *                                               newline (\n) characters, etc.
     * @param string             $thumbnailUrl       A URL to a thumbnail image of the team’s logo.
     * @param string             $teamName           The team’s name.
     * @param string             $teamDisplayName    The team’s display name.
     * @param string             $id                 An ID that identifies the team.
     * @param array|null         $users              The list of team members.
     */
    public function __construct(
        private string $broadcasterId,
        private string $broadcasterLogin,
        private string $broadcasterName,
        private string $backgroundImageUrl,
        private string $banner,
        private \DateTimeImmutable $createdAt,
        private \DateTimeImmutable $updatedAt,
        private string $info,
        private string $thumbnailUrl,
        private string $teamName,
        private string $teamDisplayName,
        private string $id,
        private ?array $users = null
    ) {
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getBackgroundImageUrl(): string {
        return $this->backgroundImageUrl;
    }

    public function getBanner(): string {
        return $this->banner;
    }

    public function getCreatedAt(): \DateTimeImmutable {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable {
        return $this->updatedAt;
    }

    public function getInfo(): string {
        return $this->info;
    }

    public function getThumbnailUrl(): string {
        return $this->thumbnailUrl;
    }

    public function getTeamName(): string {
        return $this->teamName;
    }

    public function getTeamDisplayName(): string {
        return $this->teamDisplayName;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getUsers(): ?array {
        return $this->users;
    }
}
