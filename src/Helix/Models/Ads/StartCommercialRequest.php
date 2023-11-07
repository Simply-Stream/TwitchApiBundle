<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Ads;

use SimplyStream\TwitchApiBundle\Helix\Models\AbstractModel;
use Webmozart\Assert\Assert;

final readonly class StartCommercialRequest extends AbstractModel
{
    /**
     * @param string $broadcasterId The ID of the partner or affiliate broadcaster that wants to run the commercial. This ID must match the
     *                              user ID found in the OAuth token.
     * @param int    $length        The length of the commercial to run, in seconds. Twitch tries to serve a commercial that’s the
     *                              requested length, but it may be shorter or longer. The maximum length you should request is 180
     *                              seconds.
     */
    public function __construct(
        private string $broadcasterId,
        private int $length
    ) {
        Assert::stringNotEmpty($this->broadcasterId, 'Broadcaster ID can\'t be empty');
        Assert::minLength($this->length, 1, sprintf('A commercial should at least be 1 second long. Got "%s"', $this->length));
        Assert::maxLength($this->length, 180, sprintf('The maximum length you should request is 180 seconds. Got "%s"', $this->length));
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getLength(): int {
        return $this->length;
    }
}
