<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity;

class Message
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var Emote[]
     */
    protected $emotes;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Emote[]
     */
    public function getEmotes(): array
    {
        return $this->emotes;
    }

    /**
     * @param Emote[] $emotes
     *
     * @return $this
     */
    public function setEmotes(array $emotes): self
    {
        $this->emotes = $emotes;

        return $this;
    }
}
