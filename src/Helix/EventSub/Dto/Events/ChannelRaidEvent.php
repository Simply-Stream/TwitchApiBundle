<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class ChannelRaidEvent extends AbstractEvent
{
    /**
     * @var string
     */
    protected string $fromBroadcasterUserId;

    /**
     * @var string
     */
    protected string $fromBroadcasterUserLogin;

    /**
     * @var string
     */
    protected string $fromBroadcasterUserName;

    /**
     * @var string
     */
    protected string $toBroadcasterUserId;

    /**
     * @var string
     */
    protected string $toBroadcasterUserLogin;

    /**
     * @var string
     */
    protected string $toBroadcasterUserName;

    /**
     * @var int
     */
    protected int $viewers;

    /**
     * @return string
     */
    public function getFromBroadcasterUserId(): string
    {
        return $this->fromBroadcasterUserId;
    }

    /**
     * @param string $fromBroadcasterUserId
     *
     * @return $this
     */
    public function setFromBroadcasterUserId(string $fromBroadcasterUserId): self
    {
        $this->fromBroadcasterUserId = $fromBroadcasterUserId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromBroadcasterUserLogin(): string
    {
        return $this->fromBroadcasterUserLogin;
    }

    /**
     * @param string $fromBroadcasterUserLogin
     *
     * @return $this
     */
    public function setFromBroadcasterUserLogin(string $fromBroadcasterUserLogin): self
    {
        $this->fromBroadcasterUserLogin = $fromBroadcasterUserLogin;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromBroadcasterUserName(): string
    {
        return $this->fromBroadcasterUserName;
    }

    /**
     * @param string $fromBroadcasterUserName
     *
     * @return $this
     */
    public function setFromBroadcasterUserName(string $fromBroadcasterUserName): self
    {
        $this->fromBroadcasterUserName = $fromBroadcasterUserName;

        return $this;
    }

    /**
     * @return string
     */
    public function getToBroadcasterUserId(): string
    {
        return $this->toBroadcasterUserId;
    }

    /**
     * @param string $toBroadcasterUserId
     *
     * @return $this
     */
    public function setToBroadcasterUserId(string $toBroadcasterUserId): self
    {
        $this->toBroadcasterUserId = $toBroadcasterUserId;

        return $this;
    }

    /**
     * @return string
     */
    public function getToBroadcasterUserLogin(): string
    {
        return $this->toBroadcasterUserLogin;
    }

    /**
     * @param string $toBroadcasterUserLogin
     *
     * @return $this
     */
    public function setToBroadcasterUserLogin(string $toBroadcasterUserLogin): self
    {
        $this->toBroadcasterUserLogin = $toBroadcasterUserLogin;

        return $this;
    }

    /**
     * @return string
     */
    public function getToBroadcasterUserName(): string
    {
        return $this->toBroadcasterUserName;
    }

    /**
     * @param string $toBroadcasterUserName
     *
     * @return $this
     */
    public function setToBroadcasterUserName(string $toBroadcasterUserName): self
    {
        $this->toBroadcasterUserName = $toBroadcasterUserName;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewers(): int
    {
        return $this->viewers;
    }

    /**
     * @param int $viewers
     *
     * @return $this
     */
    public function setViewers(int $viewers): self
    {
        $this->viewers = $viewers;

        return $this;
    }
}
