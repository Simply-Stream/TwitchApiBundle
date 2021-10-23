<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

abstract class AbstractEvent implements EventInterface
{
    /**
     * @var string
     */
    protected $id;

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
     * @return AbstractEvent
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }
}
