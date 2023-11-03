<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Polls;

final readonly class Poll
{
    /**
     * @param string             $id                         An ID that identifies the poll.
     * @param string             $broadcasterId              An ID that identifies the broadcaster that created the poll.
     * @param string             $broadcasterName            The broadcaster’s display name.
     * @param string             $broadcasterLogin           The broadcaster’s login name.
     * @param string             $title                      The question that viewers are voting on. For example, What game should I play
     *                                                       next? The title may contain a maximum of 60 characters.
     * @param Choice[]           $choices                    A list of choices that viewers can choose from. The list will contain a
     *                                                       minimum of two choices and up to a maximum of five choices.
     * @param bool               $bitsVotingEnabled          Not used; will be set to false.
     * @param int                $bitsPerVote                Not used; will be set to 0.
     * @param bool               $channelPointsVotingEnabled A Boolean value that indicates whether viewers may cast additional votes using
     *                                                       Channel Points. For information about Channel Points, see Channel Points
     *                                                       Guide.
     * @param int                $channelPointsPerVote       The number of points the viewer must spend to cast one additional vote.
     * @param string             $status                     The poll’s status. Valid values are:
     *                                                       - ACTIVE — The poll is running.
     *                                                       - COMPLETED — The poll ended on schedule (see the duration field).
     *                                                       - TERMINATED — The poll was terminated before its scheduled end.
     *                                                       - ARCHIVED — The poll has been archived and is no longer visible on the
     *                                                       channel.
     *                                                       - MODERATED — The poll was deleted.
     *                                                       - INVALID — Something went wrong while determining the state.
     * @param int                $duration                   The length of time (in seconds) that the poll will run for.
     * @param \DateTimeImmutable $startedAt                  The UTC date and time (in RFC3339 format) of when the poll began.
     * @param \DateTimeImmutable $endedAt                    The UTC date and time (in RFC3339 format) of when the poll ended. If status is
     *                                                       ACTIVE, this field is set to null.
     */
    public function __construct(
        private string $id,
        private string $broadcasterId,
        private string $broadcasterName,
        private string $broadcasterLogin,
        private string $title,
        private array $choices,
        private bool $bitsVotingEnabled,
        private int $bitsPerVote,
        private bool $channelPointsVotingEnabled,
        private int $channelPointsPerVote,
        private string $status,
        private int $duration,
        private \DateTimeImmutable $startedAt,
        private \DateTimeImmutable $endedAt,
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getChoices(): array {
        return $this->choices;
    }

    public function isBitsVotingEnabled(): bool {
        return $this->bitsVotingEnabled;
    }

    public function getBitsPerVote(): int {
        return $this->bitsPerVote;
    }

    public function isChannelPointsVotingEnabled(): bool {
        return $this->channelPointsVotingEnabled;
    }

    public function getChannelPointsPerVote(): int {
        return $this->channelPointsPerVote;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getDuration(): int {
        return $this->duration;
    }

    public function getStartedAt(): \DateTimeImmutable {
        return $this->startedAt;
    }

    public function getEndedAt(): \DateTimeImmutable {
        return $this->endedAt;
    }
}
