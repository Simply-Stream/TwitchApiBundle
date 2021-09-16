<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

class ChannelRaidEvent extends AbstractEvent
{
    /**
     * @var string
     */
    protected $fromBroadcasterUserId;

    /**
     * @var string
     */
    protected $fromBroadcasterUserLogin;

    /**
     * @var string
     */
    protected $fromBroadcasterUserName;

    /**
     * @var string
     */
    protected $toBroadcasterUserId;

    /**
     * @var string
     */
    protected $toBroadcasterUserLogin;

    /**
     * @var string
     */
    protected $toBroadcasterUserName;

    /**
     * @var int
     */
    protected $viewer;

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
     * @return ChannelRaidEvent
     */
    public function setFromBroadcasterUserId(string $fromBroadcasterUserId): ChannelRaidEvent
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
     * @return ChannelRaidEvent
     */
    public function setFromBroadcasterUserLogin(string $fromBroadcasterUserLogin): ChannelRaidEvent
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
     * @return ChannelRaidEvent
     */
    public function setFromBroadcasterUserName(string $fromBroadcasterUserName): ChannelRaidEvent
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
     * @return ChannelRaidEvent
     */
    public function setToBroadcasterUserId(string $toBroadcasterUserId): ChannelRaidEvent
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
     * @return ChannelRaidEvent
     */
    public function setToBroadcasterUserLogin(string $toBroadcasterUserLogin): ChannelRaidEvent
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
     * @return ChannelRaidEvent
     */
    public function setToBroadcasterUserName(string $toBroadcasterUserName): ChannelRaidEvent
    {
        $this->toBroadcasterUserName = $toBroadcasterUserName;

        return $this;
    }

    /**
     * @return int
     */
    public function getViewer(): int
    {
        return $this->viewer;
    }

    /**
     * @param int $viewer
     *
     * @return ChannelRaidEvent
     */
    public function setViewer(int $viewer): ChannelRaidEvent
    {
        $this->viewer = $viewer;

        return $this;
    }
}
