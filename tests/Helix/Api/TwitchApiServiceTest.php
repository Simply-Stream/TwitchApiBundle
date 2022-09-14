<?php

/*
 * MIT License
 *
 * Copyright (c) 2021 AaricDev (simply-stream.com)
 */

namespace SimplyStream\TwitchApiBundle\Tests\Helix\Api;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use SimplyStream\TwitchApiBundle\Helix\Api\TwitchApiService;
use SimplyStream\TwitchApiBundle\Helix\Authentication\Provider\TwitchProvider;

/**
 * @package SimplyStream\TwitchApiBundle\Tests\Helix\Api
 *
 * @covers  \SimplyStream\TwitchApiBundle\Helix\Api\TwitchApiService
 */
class TwitchApiServiceTest extends TestCase
{
    public function testSuccessfulGamesRequest(): void
    {
        self::markTestIncomplete('Needs a fix for getGames');

        $httpClientMock = $this->createMock(ClientInterface::class);
        $requestFactoryMock = $this->createMock(RequestFactoryInterface::class);
        $twitchMock = $this->createMock(TwitchProvider::class);
        $twitchMock
            ->expects(self::once())
            ->method('getAccessToken')
            ->with('client_credentials')
            ->willThrowException(new IdentityProviderException('Invalid credentials', 403, []));

        $sut = new TwitchApiService($httpClientMock, $requestFactoryMock);
        $sut->getGames();
    }
}
