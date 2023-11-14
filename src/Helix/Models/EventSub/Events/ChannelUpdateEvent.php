<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ChannelUpdateEvent extends Event
{
    /**
     * @param string $broadcasterUserId           The broadcaster’s user ID.
     * @param string $broadcasterUserLogin        The broadcaster’s user login.
     * @param string $broadcasterUserName         The broadcaster’s user display name.
     * @param string $title                       The channel’s stream title.
     * @param string $language                    The channel’s broadcast language.
     * @param string $categoryId                  The channel’s category ID.
     * @param string $categoryName                The category name.
     * @param array  $contentClassificationLabels Array of content classification label IDs currently applied on the Channel. To retrieve a
     *                                            list of all possible IDs, use the Get Content Classification Labels API endpoint.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $title,
        private string $language,
        private string $categoryId,
        private string $categoryName,
        private array $contentClassificationLabels = []
    ) {
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getLanguage(): string {
        return $this->language;
    }

    public function getCategoryId(): string {
        return $this->categoryId;
    }

    public function getCategoryName(): string {
        return $this->categoryName;
    }

    public function getContentClassificationLabels(): array {
        return $this->contentClassificationLabels;
    }
}
