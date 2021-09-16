<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Conditions\ConditionInterface;
use SimplyStream\TwitchApiBundle\Helix\EventSub\Transport;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\DTO
 */
class Subscription
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var ConditionInterface
     */
    protected $condition;

    /**
     * @var Transport
     */
    protected $transport;

    /**
     * @var string
     */
    protected $version;

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
