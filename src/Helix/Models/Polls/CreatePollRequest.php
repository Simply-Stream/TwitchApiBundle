<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Polls;

use Webmozart\Assert\Assert;

final readonly class CreatePollRequest
{
    /**
     * @param string              $broadcasterId              The ID of the broadcaster that’s running the poll. This ID must match the
     *                                                        user ID in the user access token.
     * @param string              $title                      The question that viewers will vote on. For example, What game should I play
     *                                                        next? The question may contain a maximum of 60 characters.
     * @param array{title:string} $choices                    A list of choices that viewers may choose from. The list must contain a
     *                                                        minimum of 2 choices and up to a maximum of 5 choices.
     * @param int                 $duration                   The length of time (in seconds) that the poll will run for. The minimum is 15
     *                                                        seconds and the maximum is 1800 seconds (30 minutes).
     * @param bool                $channelPointsVotingEnabled A Boolean value that indicates whether viewers may cast additional votes
     *                                                        using Channel Points. If true, the viewer may cast more than one vote but
     *                                                        each additional vote costs the number of Channel Points specified in
     *                                                        channel_points_per_vote. The default is false (viewers may cast only one
     *                                                        vote). For information about Channel Points, see Channel Points Guide.
     * @param int|null            $channelPointsPerVote       The number of points that the viewer must spend to cast one additional vote.
     *                                                        The minimum is 1 and the maximum is 1000000. Set only if
     *                                                        ChannelPointsVotingEnabled is true.
     */
    public function __construct(
        private string $broadcasterId,
        private string $title,
        private array $choices,
        private int $duration,
        private bool $channelPointsVotingEnabled = false,
        private ?int $channelPointsPerVote = null
    ) {
        Assert::stringNotEmpty($this->title, 'Title can\'t be empty');
        Assert::maxLength($this->title, 60, 'The maximum length for title is 60 characters');
        Assert::allKeyExists($this->choices, 'title', 'Choices need a title');

        foreach ($this->choices as $key => $choice) {
            Assert::maxLength($choice, 25, sprintf('Choice #%s title can\'t be longer than 25 characters', $key));
        }

        Assert::greaterThanEq($this->duration, 15, 'A poll needs to be at least 15 seconds long');
        Assert::lessThanEq($this->duration, 1800, 'The longest poll can only be 1800 seconds long');

        if ($this->channelPointsVotingEnabled) {
            Assert::greaterThanEq($this->channelPointsPerVote, 1, 'The minimum is 1 channelpoint per vote');
            Assert::greaterThanEq($this->channelPointsPerVote, 1000000, 'The maximum is 1000000 channelpoint per vote');
        }
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getChoices(): array {
        return $this->choices;
    }

    public function getDuration(): int {
        return $this->duration;
    }

    public function isChannelPointsVotingEnabled(): bool {
        return $this->channelPointsVotingEnabled;
    }

    public function getChannelPointsPerVote(): int {
        return $this->channelPointsPerVote;
    }
}
