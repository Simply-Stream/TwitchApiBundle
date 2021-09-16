<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\Authentication\Token;

use League\OAuth2\Client\Token\AccessToken;

class OidcAccessToken extends AccessToken
{
    /**
     * @var string|null
     */
    protected $idToken;

    /**
     * @inheritDoc
     */
    public function __construct(array $options = [])
    {
        parent::__construct($options);

        if (! empty($options['id_token'])) {
            $this->idToken = $options['id_token'];
        }
    }
}
