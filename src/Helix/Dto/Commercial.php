<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Commercial
{
    /**
     * The length of the commercial you requested. If you request a commercial that’s longer than 180 seconds, the API uses 180 seconds.
     *
     * @var int
     */
    protected int $length;

    /**
     * A message that indicates whether Twitch was able to serve an ad.
     *
     * @var string
     */
    protected string $message;

    /**
     * The number of seconds you must wait before running another commercial.
     *
     * @var int
     */
    protected int $retry_after;

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     *
     * @return Commercial
     */
    public function setLength(int $length): Commercial
    {
        $this->length = $length;

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
     * @return Commercial
     */
    public function setMessage(string $message): Commercial
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return int
     */
    public function getRetryAfter(): int
    {
        return $this->retry_after;
    }

    /**
     * @param int $retry_after
     *
     * @return Commercial
     */
    public function setRetryAfter(int $retry_after): Commercial
    {
        $this->retry_after = $retry_after;

        return $this;
    }
}
