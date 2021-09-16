<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

trait HasModeratorUser
{
    /**
     * @var string
     */
    protected $moderatorUserId;

    /**
     * @var string
     */
    protected $moderatorUserLogin;

    /**
     * @var string
     */
    protected $moderatorUserName;

    /**
     * @return string
     */
    public function getModeratorUserId(): string
    {
        return $this->moderatorUserId;
    }

    /**
     * @param string $moderatorUserId
     *
     * @return $this
     */
    public function setModeratorUserId(string $moderatorUserId): self
    {
        $this->moderatorUserId = $moderatorUserId;

        return $this;
    }

    /**
     * @return string
     */
    public function getModeratorUserLogin(): string
    {
        return $this->moderatorUserLogin;
    }

    /**
     * @param string $moderatorUserLogin
     *
     * @return $this
     */
    public function setModeratorUserLogin(string $moderatorUserLogin): self
    {
        $this->moderatorUserLogin = $moderatorUserLogin;

        return $this;
    }

    /**
     * @return string
     */
    public function getModeratorUserName(): string
    {
        return $this->moderatorUserName;
    }

    /**
     * @param string $moderatorUserName
     *
     * @return $this
     */
    public function setModeratorUserName(string $moderatorUserName): self
    {
        $this->moderatorUserName = $moderatorUserName;

        return $this;
    }
}
