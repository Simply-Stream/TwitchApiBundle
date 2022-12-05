<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\Commercial;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class AdsApi extends AbstractApi
{
    protected const BASE_PATH = 'commercial';

    /**
     * Starts a commercial on the specified channel.
     *
     * NOTE: Only partners and affiliates may run commercials and they must be streaming live at the time.
     *
     * NOTE: Only the broadcaster may start a commercial; the broadcaster’s editors and moderators may not start commercials on behalf of
     * the broadcaster.
     *
     * Authentication:
     * Requires a user access token that includes the channel:edit:commercial scope.
     *
     * @param string               $broadcasterId The ID of the partner or affiliate broadcaster that wants to run the commercial. This
     *                                            ID must match the user ID found in the OAuth token.
     * @param int                  $length        The length of the commercial to run, in seconds. Twitch tries to serve a commercial
     *                                            that’s the requested length, but it may be shorter or longer. The maximum length you
     *                                            should request is 180 seconds.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function startCommercial(string $broadcasterId, int $length, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: 'channels/' . self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'length' => min($length, 180),
            ],
            type: 'array<' . Commercial::class . '>',
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }
}
