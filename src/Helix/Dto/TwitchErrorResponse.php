<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class TwitchErrorResponse implements TwitchResponseInterface
{
    /** @var string */
    protected string $error;

    /** @var int */
    protected int $status;

    /** @var string */
    protected string $message;

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     *
     * @return TwitchErrorResponse
     */
    public function setError(string $error): TwitchErrorResponse
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return TwitchErrorResponse
     */
    public function setStatus(int $status): TwitchErrorResponse
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return TwitchErrorResponse
     */
    public function setMessage(string $message): TwitchErrorResponse
    {
        $this->message = $message;

        return $this;
    }
}
