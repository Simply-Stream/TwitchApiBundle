<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

trait HasUser
{
    /**
     * @var string
     */
    protected $userId;

    /**
     * @var string
     */
    protected $userLogin;

    /**
     * @var string
     */
    protected $userName;

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     *
     * @return $this
     */
    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    /**
     * @param string $userLogin
     *
     * @return $this
     */
    public function setUserLogin(string $userLogin): self
    {
        $this->userLogin = $userLogin;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     *
     * @return $this
     */
    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }
}
