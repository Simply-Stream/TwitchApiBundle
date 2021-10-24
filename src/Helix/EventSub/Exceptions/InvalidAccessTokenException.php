<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions;

use League\OAuth2\Client\Token\AccessTokenInterface;
use Throwable;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\EventSub\Exceptions
 */
class InvalidAccessTokenException extends \RuntimeException
{
    /**
     * @inheritdoc
     */
    protected $message = 'Invalid access token';

    /**
     * @param AccessTokenInterface|null $accessToken
     * @param string                    $message
     * @param int                       $code
     * @param Throwable|null            $previous
     */
    public function __construct(?AccessTokenInterface $accessToken, $message = "", $code = 0, Throwable $previous = null)
    {
        if ($accessToken) {
            $this->message .= ": ${accessToken}";
        }

        parent::__construct($message ?? $this->message, $code, $previous);
    }
}
