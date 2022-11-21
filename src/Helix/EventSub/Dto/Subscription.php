<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions\ConditionInterface;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Transport;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\DTO
 */
class Subscription
{
    /**
     * @var string|null
     */
    protected ?string $id;

    /**
     * @var string|null
     */
    protected ?string $status;

    /**
     * @var \DateTime|null
     */
    protected ?\DateTime $createdAt;

    /**
     * @var int|null
     */
    protected ?int $cost;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var ConditionInterface
     */
    protected ConditionInterface $condition;

    /**
     * @var Transport
     */
    protected Transport $transport;

    /**
     * @var string|null
     */
    protected ?string $version;

    /**
     * @param ConditionInterface $condition
     * @param Transport          $transport
     * @param string             $version
     */
    public function __construct(ConditionInterface $condition, Transport $transport, string $version = '1')
    {
        $this->type = $condition->getType();
        $this->condition = $condition;
        $this->transport = $transport;
        $this->version = $version;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int|null
     */
    public function getCost(): ?int
    {
        return $this->cost;
    }

    /**
     * @param int|null $cost
     */
    public function setCost(?int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @return ConditionInterface
     */
    public function getCondition(): ConditionInterface
    {
        return $this->condition;
    }

    /**
     * @return Transport
     */
    public function getTransport(): Transport
    {
        return $this->transport;
    }
}
