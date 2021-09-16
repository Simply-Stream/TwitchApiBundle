<?php declare(strict_types = 1);

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Helix\Authentication\Grant;

use League\OAuth2\Client\Grant\AbstractGrant;

/**
 * @package SimplyStream\TwitchApiBundle\Helix\Authentication\Grant
 */
class Oidc extends AbstractGrant
{
    /**
     * @inheritDoc
     */
    protected function getName()
    {
        return 'authorization_code';
    }

    /**
     * @inheritDoc
     */
    protected function getRequiredRequestParameters()
    {
        return ['code'];
    }
}
