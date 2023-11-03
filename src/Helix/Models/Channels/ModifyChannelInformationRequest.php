<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Channels;

use SimplyStream\TwitchApiBundle\Helix\Models\CCLs\Label;
use Webmozart\Assert\Assert;

final readonly class ModifyChannelInformationRequest
{
    /**
     * @param string|null $gameId                      The ID of the game that the user plays. The game is not updated if the ID isn’t a
     *                                                 game ID that Twitch recognizes. To unset this field, use “0” or “” (an empty
     *                                                 string).
     * @param string|null $broadcasterLanguage         The user’s preferred language. Set the value to an ISO 639-1 two-letter language
     *                                                 code (for example, en for English). Set to “other” if the user’s preferred language
     *                                                 is not a Twitch supported language. The language isn’t updated if the language code
     *                                                 isn’t a Twitch supported language.
     * @param string|null $title                       The title of the user’s stream. You may not set this field to an empty string.
     * @param int|null    $delay                       The number of seconds you want your broadcast buffered before streaming it live. The
     *                                                 delay helps ensure fairness during competitive play. Only users with Partner status
     *                                                 may set this field. The maximum delay is 900 seconds (15 minutes).
     * @param array|null  $tags                        A list of channel-defined tags to apply to the channel. To remove all tags from the
     *                                                 channel, set tags to an empty array. Tags help identify the content that the channel
     *                                                 streams. Learn More
     *
     *                                                 A channel may specify a maximum of 10 tags. Each tag is limited to a maximum of 25
     *                                                 characters and may not be an empty string or contain spaces or special characters.
     *                                                 Tags are case insensitive. For readability, consider using camelCasing or
     *                                                 PascalCasing.
     * @param Label[]     $contentClassificationLabels List of labels that should be set as the Channel’s CCLs.
     * @param bool|null   $isBrandedContent            Boolean flag indicating if the channel has branded content.
     */
    public function __construct(
        private ?string $gameId = null,
        private ?string $broadcasterLanguage = null,
        private ?string $title = null,
        private ?int $delay = null,
        private ?array $tags = null,
        private ?array $contentClassificationLabels,
        private ?bool $isBrandedContent = null
    ) {
        if (null !== $this->broadcasterLanguage) {
            Assert::regex($this->broadcasterLanguage, '^[a-zA-Z]{2}$');
        }

        if (null !== $this->title) {
            Assert::stringNotEmpty($title);
        }

        Assert::maxLength($this->delay, 900, 'The maximum delay is 900 seconds');

        if (count($this->tags) > 0) {
            Assert::allString($this->tags, 'Tags need to be strings');
            Assert::maxCount($this->tags, 10, 'A channel may specify a maximum of 10 tags');
            Assert::allMaxLength($this->tags, 25, 'Each tag is limited to a maximum of 25 characters');
            Assert::allMinLength($this->tags, 1, 'Each tag may not be an empty string');
            Assert::allNotWhitespaceOnly($this->tags, 'Each tag may not contain spaces');
            // There should also be a validation for "non-special-characters". Twitch doesn't specify this more. Beside alphabetical, Umlauts also seems to be allowed.
        }

        if (count($this->contentClassificationLabels) > 0) {
            Assert::allIsInstanceOf($this->contentClassificationLabels, Label::class, sprintf('Content classification labels need to be an instance of "%s"', Label::class));
        }
    }

    public function getDelay(): int {
        return $this->delay;
    }

    public function getGameId(): ?string {
        return $this->gameId;
    }

    public function getBroadcasterLanguage(): ?string {
        return $this->broadcasterLanguage;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function getTags(): array {
        return $this->tags;
    }

    public function getContentClassificationLabels(): array {
        return $this->contentClassificationLabels;
    }

    public function getIsBrandedContent(): ?bool {
        return $this->isBrandedContent;
    }
}
