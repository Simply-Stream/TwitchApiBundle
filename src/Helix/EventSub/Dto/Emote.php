<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

class Emote
{
    /**
     * @var int
     */
    protected int $begin;

    /**
     * @var int
     */
    protected int $end;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @return int
     */
    public function getBegin(): int
    {
        return $this->begin;
    }

    /**
     * @param int $begin
     *
     * @return $this
     */
    public function setBegin(int $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * @return int
     */
    public function getEnd(): int
    {
        return $this->end;
    }

    /**
     * @param int $end
     *
     * @return $this
     */
    public function setEnd(int $end): self
    {
        $this->end = $end;

        return $this;
    }

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
}
