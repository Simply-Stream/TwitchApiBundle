<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Polls;

final readonly class Choice
{
    /**
     * @param string $id                 An ID that identifies this choice.
     * @param string $title              The choice’s title. The title may contain a maximum of 25 characters.
     * @param int    $votes              The total number of votes cast for this choice.
     * @param int    $channelPointsVotes The number of votes cast using Channel Points.
     * @param int    $bitsVotes          Not used; will be set to 0.
     */
    public function __construct(
        private string $id,
        private string $title,
        private int $votes,
        private int $channelPointsVotes,
        private int $bitsVotes
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getVotes(): int {
        return $this->votes;
    }

    public function getChannelPointsVotes(): int {
        return $this->channelPointsVotes;
    }

    public function getBitsVotes(): int {
        return $this->bitsVotes;
    }
}
