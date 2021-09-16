<?php declare(strict_types = 1);

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

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
     * @TODO: Change to class
     *
     * @var string
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
     * @return ChannelPointsCustomRewardRedemptionAddEvent
     */
    public function setUserInput(string $userInput): ChannelPointsCustomRewardRedemptionAddEvent
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
     * @return ChannelPointsCustomRewardRedemptionAddEvent
     */
    public function setId(string $id): ChannelPointsCustomRewardRedemptionAddEvent
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
     * @return ChannelPointsCustomRewardRedemptionAddEvent
     */
    public function setStatus(string $status): ChannelPointsCustomRewardRedemptionAddEvent
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getReward(): string
    {
        return $this->reward;
    }

    /**
     * @param string $reward
     *
     * @return ChannelPointsCustomRewardRedemptionAddEvent
     */
    public function setReward(string $reward): ChannelPointsCustomRewardRedemptionAddEvent
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
     * @return ChannelPointsCustomRewardRedemptionAddEvent
     */
    public function setRedeemedAt(\DateTime $redeemedAt): ChannelPointsCustomRewardRedemptionAddEvent
    {
        $this->redeemedAt = $redeemedAt;

        return $this;
    }
}
