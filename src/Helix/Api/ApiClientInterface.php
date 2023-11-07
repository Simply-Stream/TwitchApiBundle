<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use Psr\Http\Message\UriInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\AbstractModel;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;

/**
 * @template T
 */
interface ApiClientInterface
{
    public const BASE_API_URL = 'https://api.twitch.tv/helix/';

    /**
     * @param UriInterface              $uri
     * @param string|null               $type
     * @param string                    $method
     * @param AbstractModel|null        $body
     * @param AccessTokenInterface|null $accessToken
     *
     * @return T|null
     */
    public function sendRequest(
        UriInterface $uri,
        string $type = null,
        string $method = 'GET',
        ?AbstractModel $body = null,
        ?AccessTokenInterface $accessToken = null
    ): ?TwitchResponseInterface;
}
