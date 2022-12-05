<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ChatBadge
{
    /**
     * An ID that identifies this set of chat badges. For example, Bits or Subscriber.
     *
     * @var string
     */
    protected string $set_id;

    /**
     * The list of chat badges in this set.
     *
     * @var array
     */
    protected array $versions;

    /**
     * @return string
     */
    public function getSetId(): string
    {
        return $this->set_id;
    }

    /**
     * @param string $set_id
     *
     * @return ChatBadge
     */
    public function setSetId(string $set_id): ChatBadge
    {
        $this->set_id = $set_id;

        return $this;
    }

    /**
     * @return array
     */
    public function getVersions(): array
    {
        return $this->versions;
    }

    /**
     * @param array $versions
     *
     * @return ChatBadge
     */
    public function setVersions(array $versions): ChatBadge
    {
        $this->versions = $versions;

        return $this;
    }
}
