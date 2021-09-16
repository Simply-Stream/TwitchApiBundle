<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub
 */
class Transport
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $callback;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @param string $callback
     * @param string $secret
     * @param string $method Currently only 'webhook' is supported
     */
    public function __construct(string $callback, string $secret = '', string $method = 'webhook')
    {
        $this->callback = $callback;
        $this->secret = $secret;
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getCallback(): string
    {
        return $this->callback;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret): void
    {
        $this->secret = $secret;
    }
}
