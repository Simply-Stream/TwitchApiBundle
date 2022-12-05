<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class BitLeaderboard
{
    /**
     * An ID that identifies a user on the leaderboard.
     *
     * @var string
     */
    protected string $user_id;

    /**
     * The user’s login name.
     *
     * @var string
     */
    protected string $user_login;

    /**
     * The user’s display name.
     *
     * @var string
     */
    protected string $user_name;

    /**
     * The user’s position on the leaderboard.
     *
     * @var int
     */
    protected int $rank;

    /**
     * The number of Bits the user has cheered.
     *
     * @var int
     */
    protected int $score;

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     *
     * @return BitLeaderboard
     */
    public function setUserId(string $user_id): BitLeaderboard
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserLogin(): string
    {
        return $this->user_login;
    }

    /**
     * @param string $user_login
     *
     * @return BitLeaderboard
     */
    public function setUserLogin(string $user_login): BitLeaderboard
    {
        $this->user_login = $user_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     *
     * @return BitLeaderboard
     */
    public function setUserName(string $user_name): BitLeaderboard
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     *
     * @return BitLeaderboard
     */
    public function setRank(int $rank): BitLeaderboard
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     *
     * @return BitLeaderboard
     */
    public function setScore(int $score): BitLeaderboard
    {
        $this->score = $score;

        return $this;
    }
}
