<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\ChannelPoints;

use Webmozart\Assert\Assert;

final readonly class CreateCustomRewardRequest
{
    public function __construct(
        private string $title,
        private int $cost,
        private ?string $prompt = null,
        private bool $isEnabled = true,
        private ?string $backgroundColor = null,
        private bool $isUserInputRequired = false,
        private bool $isMaxPerStreamEnabled = false,
        private ?int $maxPerStream = null,
        private bool $isMaxPerUserPerStreamEnabled = false,
        private ?int $maxPerUserPerStream = null,
        private bool $isGlobalCooldownEnabled = false,
        private ?int $globalCooldownSeconds = null,
        private bool $shouldRedemptionsSkipRequestQueue = false
    ) {
        Assert::stringNotEmpty($this->title, 'The title can\'t be an empty string');
        Assert::maxLength($this->title, 45, 'The title may contain a maximum of 45 characters');

        Assert::greaterThanEq($this->cost, 1, 'The minimum cost is 1 point');
        Assert::lessThan($this->cost, PHP_INT_MAX, sprintf('The maximum cost is %s', PHP_INT_MAX));

        if ($this->isUserInputRequired) {
            Assert::stringNotEmpty($this->prompt, 'The prompt can\'t be empty, when user input is required');
            Assert::maxLength($this->prompt, 200, 'The prompt is limited to a maximum of 200 characters');
        }

        if (null !== $this->backgroundColor) {
            Assert::regex($this->backgroundColor, '#([0-9a-fA-F]{3}){1,2}', sprintf('The given background color "%s" is not a valid hex format. Valid formats "#9147FF", "#FFF"', $this->backgroundColor));
        }

        if ($this->isMaxPerStreamEnabled) {
            Assert::greaterThanEq($this->maxPerStream, 1, 'The minimum value of max per stream is 1');
        }

        if ($this->isMaxPerUserPerStreamEnabled) {
            Assert::greaterThanEq($this->maxPerUserPerStream, 1, 'The minimum value of max per user per stream is 1');
        }

        if ($this->isGlobalCooldownEnabled) {
            Assert::greaterThanEq($this->maxPerUserPerStream, 1, 'The minimum value of global cooldown seconds is 1. However, the minimum value is 60 to be shown in Twitch UI');
        }
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getCost(): int {
        return $this->cost;
    }

    public function getPrompt(): ?string {
        return $this->prompt;
    }

    public function isEnabled(): bool {
        return $this->isEnabled;
    }

    public function getBackgroundColor(): ?string {
        return $this->backgroundColor;
    }

    public function isUserInputRequired(): bool {
        return $this->isUserInputRequired;
    }

    public function isMaxPerStreamEnabled(): bool {
        return $this->isMaxPerStreamEnabled;
    }

    public function getMaxPerStream(): ?int {
        return $this->maxPerStream;
    }

    public function isMaxPerUserPerStreamEnabled(): bool {
        return $this->isMaxPerUserPerStreamEnabled;
    }

    public function getMaxPerUserPerStream(): ?int {
        return $this->maxPerUserPerStream;
    }

    public function isGlobalCooldownEnabled(): bool {
        return $this->isGlobalCooldownEnabled;
    }

    public function getGlobalCooldownSeconds(): ?int {
        return $this->globalCooldownSeconds;
    }

    public function isShouldRedemptionsSkipRequestQueue(): bool {
        return $this->shouldRedemptionsSkipRequestQueue;
    }
}
