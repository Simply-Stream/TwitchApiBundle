<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

class Outcome
{
    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var string - Valid values: pink|blue
     */
    protected string $color;

    /**
     * @var int
     */
    protected int $users;

    /**
     * @var int
     */
    protected int $channelPoints;

    /**
     * @var TopPredictors
     */
    protected TopPredictors $topPredictors;

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
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return $this
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return int
     */
    public function getUsers(): int
    {
        return $this->users;
    }

    /**
     * @param int $users
     *
     * @return $this
     */
    public function setUsers(int $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return int
     */
    public function getChannelPoints(): int
    {
        return $this->channelPoints;
    }

    /**
     * @param int $channelPoints
     *
     * @return $this
     */
    public function setChannelPoints(int $channelPoints): self
    {
        $this->channelPoints = $channelPoints;

        return $this;
    }

    /**
     * @return TopPredictors
     */
    public function getTopPredictors(): TopPredictors
    {
        return $this->topPredictors;
    }

    /**
     * @param TopPredictors $topPredictors
     *
     * @return $this
     */
    public function setTopPredictors(TopPredictors $topPredictors): self
    {
        $this->topPredictors = $topPredictors;

        return $this;
    }
}
