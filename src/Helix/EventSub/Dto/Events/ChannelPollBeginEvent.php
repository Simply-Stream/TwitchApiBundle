<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\BitsVoting;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\ChannelPointsVoting;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Choice;

class ChannelPollBeginEvent extends AbstractEvent
{
    use HasBroadcasterUser;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $title;

    /**
     * @var Choice[]
     */
    protected array $choices;

    /**
     * @var BitsVoting
     */
    protected BitsVoting $bitsVoting;

    /**
     * @var ChannelPointsVoting
     */
    protected ChannelPointsVoting $channelPointsVoting;

    /**
     * @var string
     */
    protected string $startedAt;

    /**
     * @var string
     */
    protected string $endsAt;

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
     * @return Choice[]
     */
    public function getChoices(): array
    {
        return $this->choices;
    }

    /**
     * @param Choice[] $choices
     *
     * @return $this
     */
    public function setChoices(array $choices): self
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * @return BitsVoting
     */
    public function getBitsVoting(): BitsVoting
    {
        return $this->bitsVoting;
    }

    /**
     * @param BitsVoting $bitsVoting
     *
     * @return $this
     */
    public function setBitsVoting(BitsVoting $bitsVoting): self
    {
        $this->bitsVoting = $bitsVoting;

        return $this;
    }

    /**
     * @return ChannelPointsVoting
     */
    public function getChannelPointsVoting(): ChannelPointsVoting
    {
        return $this->channelPointsVoting;
    }

    /**
     * @param ChannelPointsVoting $channelPointsVoting
     *
     * @return $this
     */
    public function setChannelPointsVoting(ChannelPointsVoting $channelPointsVoting): self
    {
        $this->channelPointsVoting = $channelPointsVoting;

        return $this;
    }

    /**
     * @return string
     */
    public function getStartedAt(): string
    {
        return $this->startedAt;
    }

    /**
     * @param string $startedAt
     *
     * @return $this
     */
    public function setStartedAt(string $startedAt): self
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndsAt(): string
    {
        return $this->endsAt;
    }

    /**
     * @param string $endsAt
     *
     * @return $this
     */
    public function setEndsAt(string $endsAt): self
    {
        $this->endsAt = $endsAt;

        return $this;
    }
}
