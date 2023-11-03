<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Bits;

final readonly class BitsLeaderboard
{
    /**
     * @param string $userId    An ID that identifies a user on the leaderboard.
     * @param string $userLogin The user’s login name.
     * @param string $userName  The user’s display name.
     * @param int    $rank      The user’s position on the leaderboard.
     * @param int    $score     The number of Bits the user has cheered.
     */
    public function __construct(
        private string $userId,
        private string $userLogin,
        private string $userName,
        private int $rank,
        private int $score
    ) {
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getRank(): int {
        return $this->rank;
    }

    public function getScore(): int {
        return $this->score;
    }
}
