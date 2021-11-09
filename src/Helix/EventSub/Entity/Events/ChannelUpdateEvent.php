<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelUpdateEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $categoryId;

    /**
     * @var string
     */
    protected $categoryName;

    /**
     * @var bool
     */
    protected $isMature;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return ChannelUpdateEvent
     */
    public function setTitle(string $title): ChannelUpdateEvent
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language
     *
     * @return ChannelUpdateEvent
     */
    public function setLanguage(string $language): ChannelUpdateEvent
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @param string $categoryId
     *
     * @return ChannelUpdateEvent
     */
    public function setCategoryId(string $categoryId): ChannelUpdateEvent
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     *
     * @return ChannelUpdateEvent
     */
    public function setCategoryName(string $categoryName): ChannelUpdateEvent
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsMature(): bool
    {
        return $this->isMature;
    }

    /**
     * @param bool $isMature
     *
     * @return ChannelUpdateEvent
     */
    public function setIsMature(bool $isMature): ChannelUpdateEvent
    {
        $this->isMature = $isMature;

        return $this;
    }
}
