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
    protected string $userInput;

    /**
     * @var string
     */
    protected string $id;

    /**
     * @var string
     */
    protected string $status;

    /**
     * @var Reward
     */
    protected Reward $reward;

    /**
     * @var string
     */
    protected string $redeemedAt;

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
     * @return string
     */
    public function getRedeemedAt(): string
    {
        return $this->redeemedAt;
    }

    /**
     * @param string $redeemedAt
     *
     * @return $this
     */
    public function setRedeemedAt(string $redeemedAt): self
    {
        $this->redeemedAt = $redeemedAt;

        return $this;
    }
}
