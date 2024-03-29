<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\GlobalCooldown;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Image;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\MaxPerStream;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\MaxPerUserPerStream;

class ChannelPointsCustomRewardAddEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var bool
     */
    protected bool $isEnabled;

    /**
     * @var bool
     */
    protected bool $isPaused;

    /**
     * @var bool
     */
    protected bool $isInStock;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var int
     */
    protected int $cost;

    /**
     * @var string
     */
    protected string $prompt;

    /**
     * @var bool
     */
    protected bool $isUserInputRequired;

    /**
     * @var bool
     */
    protected bool $shouldRedemptionSkipRequestQueue;

    /**
     * @var MaxPerStream
     */
    protected MaxPerStream $maxPerStream;

    /**
     * @var MaxPerUserPerStream
     */
    protected MaxPerUserPerStream $maxPerUserPerStream;

    /**
     * @var string
     */
    protected string $backgroundColor;

    /**
     * @var ?Image
     */
    protected ?Image $image;

    /**
     * @var Image
     */
    protected Image $defaultImage;

    /**
     * @var GlobalCooldown
     */
    protected GlobalCooldown $globalCooldown;

    /**
     * @var ?string
     */
    protected ?string $cooldownExpiresAt;

    /**
     * @var ?int
     */
    protected ?int $redemptionsRedeemedCurrentStream;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @param bool $isEnabled
     *
     * @return $this
     */
    public function setIsEnabled(bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsPaused(): bool
    {
        return $this->isPaused;
    }

    /**
     * @param bool $isPaused
     *
     * @return $this
     */
    public function setIsPaused(bool $isPaused): self
    {
        $this->isPaused = $isPaused;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsInStock(): bool
    {
        return $this->isInStock;
    }

    /**
     * @param bool $isInStock
     *
     * @return $this
     */
    public function setIsInStock(bool $isInStock): self
    {
        $this->isInStock = $isInStock;

        return $this;
    }

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
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     *
     * @return $this
     */
    public function setCost(int $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrompt(): string
    {
        return $this->prompt;
    }

    /**
     * @param string $prompt
     *
     * @return $this
     */
    public function setPrompt(string $prompt): self
    {
        $this->prompt = $prompt;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsUserInputRequired(): bool
    {
        return $this->isUserInputRequired;
    }

    /**
     * @param bool $isUserInputRequired
     *
     * @return $this
     */
    public function setIsUserInputRequired(bool $isUserInputRequired): self
    {
        $this->isUserInputRequired = $isUserInputRequired;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShouldRedemptionSkipRequestQueue(): bool
    {
        return $this->shouldRedemptionSkipRequestQueue;
    }

    /**
     * @param bool $shouldRedemptionSkipRequestQueue
     *
     * @return $this
     */
    public function setShouldRedemptionSkipRequestQueue(bool $shouldRedemptionSkipRequestQueue): self
    {
        $this->shouldRedemptionSkipRequestQueue = $shouldRedemptionSkipRequestQueue;

        return $this;
    }

    /**
     * @return MaxPerStream
     */
    public function getMaxPerStream(): MaxPerStream
    {
        return $this->maxPerStream;
    }

    /**
     * @param MaxPerStream $maxPerStream
     *
     * @return $this
     */
    public function setMaxPerStream(MaxPerStream $maxPerStream): self
    {
        $this->maxPerStream = $maxPerStream;

        return $this;
    }

    /**
     * @return MaxPerUserPerStream
     */
    public function getMaxPerUserPerStream(): MaxPerUserPerStream
    {
        return $this->maxPerUserPerStream;
    }

    /**
     * @param MaxPerUserPerStream $maxPerUserPerStream
     *
     * @return $this
     */
    public function setMaxPerUserPerStream(MaxPerUserPerStream $maxPerUserPerStream): self
    {
        $this->maxPerUserPerStream = $maxPerUserPerStream;

        return $this;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     *
     * @return $this
     */
    public function setBackgroundColor(string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * @return Image|null
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image|null $image
     *
     * @return $this
     */
    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Image
     */
    public function getDefaultImage(): Image
    {
        return $this->defaultImage;
    }

    /**
     * @param Image $defaultImage
     *
     * @return $this
     */
    public function setDefaultImage(Image $defaultImage): self
    {
        $this->defaultImage = $defaultImage;

        return $this;
    }

    /**
     * @return GlobalCooldown
     */
    public function getGlobalCooldown(): GlobalCooldown
    {
        return $this->globalCooldown;
    }

    /**
     * @param GlobalCooldown $globalCooldown
     *
     * @return $this
     */
    public function setGlobalCooldown(GlobalCooldown $globalCooldown): self
    {
        $this->globalCooldown = $globalCooldown;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCooldownExpiresAt(): ?string
    {
        return $this->cooldownExpiresAt;
    }

    /**
     * @param string|null $cooldownExpiresAt
     *
     * @return $this
     */
    public function setCooldownExpiresAt(?string $cooldownExpiresAt): self
    {
        $this->cooldownExpiresAt = $cooldownExpiresAt;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getRedemptionsRedeemedCurrentStream(): ?int
    {
        return $this->redemptionsRedeemedCurrentStream;
    }

    /**
     * @param int|null $redemptionsRedeemedCurrentStream
     *
     * @return $this
     */
    public function setRedemptionsRedeemedCurrentStream(?int $redemptionsRedeemedCurrentStream): self
    {
        $this->redemptionsRedeemedCurrentStream = $redemptionsRedeemedCurrentStream;

        return $this;
    }
}
