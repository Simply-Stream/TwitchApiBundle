<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

use JMS\Serializer\Annotation as Serializer;

class ChatBadgeSet
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
     * @Serializer\Type("array<SimplyStream\TwitchApiBundle\Helix\Dto\ChatBadge>")
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
     * @return ChatBadgeSet
     */
    public function setSetId(string $set_id): ChatBadgeSet
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
     * @return ChatBadgeSet
     */
    public function setVersions(array $versions): ChatBadgeSet
    {
        $this->versions = $versions;

        return $this;
    }
}
