<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Reward;

class ChannelPointsCustomRewardRedemptionAddEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;

    /**
     * @var string
     */
    protected $userInput;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var Reward
     */
    protected $reward;

    /**
     * @var \DateTime
     */
    protected $redeemedAt;

    /**
     * @return string
     */
    public function getUserInput(): string
    {
        return $this->userInput;
    }

    /**
     * @param string $userInput
     *
     * @return $this
     */
    public function setUserInput(string $userInput): self
    {
        $this->userInput = $userInput;

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

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Reward
     */
    public function getReward(): Reward
    {
        return $this->reward;
    }

    /**
     * @param Reward $reward
     *
     * @return $this
     */
    public function setReward(Reward $reward): self
    {
        $this->reward = $reward;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getRedeemedAt(): \DateTime
    {
        return $this->redeemedAt;
    }

    /**
     * @param \DateTime $redeemedAt
     *
     * @return $this
     */
    public function setRedeemedAt(\DateTime $redeemedAt): self
    {
        $this->redeemedAt = $redeemedAt;

        return $this;
    }
}
