<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Moderation;

use Webmozart\Assert\Assert;

final readonly class AddBlockedTermRequest
{
    /**
     * @param string $text The word or phrase to block from being used in the broadcaster’s chat room. The term must contain a minimum of 2
     *                     characters and may contain up to a maximum of 500 characters.
     *
     *                     Terms may include a wildcard character (*). The wildcard character must appear at the beginning or end of a word
     *                     or set of characters. For example, *foo or foo*.
     *
     *                     If the blocked term already exists, the response contains the existing blocked term.
     */
    public function __construct(
        private string $text
    ) {
        Assert::minLength($this->text, 2, 'The term must contain a minimum of 2 characters');
        Assert::maxLength($this->text, 500, 'The term must contain a maximum of 500 characters');
    }

    public function getText(): string {
        return $this->text;
    }
}
