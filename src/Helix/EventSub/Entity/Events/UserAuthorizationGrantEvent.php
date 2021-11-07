<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class UserAuthorizationGrantEvent extends AbstractEvent
{
    use HasUser;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }
}
