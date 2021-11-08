<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity;

class Choice
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $bitsVotes;

    /**
     * @var int
     */
    protected $channelPointsVotes;

    /**
     * @var int
     */
    protected $votes;

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
     * @return int
     */
    public function getBitsVotes(): int
    {
        return $this->bitsVotes;
    }

    /**
     * @param int $bitsVotes
     *
     * @return $this
     */
    public function setBitsVotes(int $bitsVotes): self
    {
        $this->bitsVotes = $bitsVotes;

        return $this;
    }

    /**
     * @return int
     */
    public function getChannelPointsVotes(): int
    {
        return $this->channelPointsVotes;
    }

    /**
     * @param int $channelPointsVotes
     *
     * @return $this
     */
    public function setChannelPointsVotes(int $channelPointsVotes): self
    {
        $this->channelPointsVotes = $channelPointsVotes;

        return $this;
    }

    /**
     * @return int
     */
    public function getVotes(): int
    {
        return $this->votes;
    }

    /**
     * @param int $votes
     *
     * @return $this
     */
    public function setVotes(int $votes): self
    {
        $this->votes = $votes;

        return $this;
    }
}
