<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\Commercial;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class AdsApi extends AbstractApi
{
    protected const BASE_PATH = 'channels';

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
    public function startCommercial(
        string $broadcasterId,
        int $length,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/commercial',
            query: [
                'broadcaster_id' => $broadcasterId,
                'length' => min($length, 180),
            ],
            type: Commercial::class . '[]',
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) This endpoint returns ad schedule related information, including snooze, when the last ad was run, when the next ad is
     * scheduled, and if the channel is currently in pre-roll free time.
     *
     * Authorization:
     * Requires a user access token that includes the channel:read:ads scope. The user_id in the user access token must match
     * the broadcaster_id.
     *
     * @param string               $broadcasterId Provided broadcaster_id must match the user_id in the auth token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getAdSchedule(
        string $broadcasterId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/ads',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) If available, pushes back the timestamp of the upcoming automatic mid-roll ad by 5 minutes. This endpoint duplicates the
     * snooze functionality in the creator dashboard’s Ads Manager.
     *
     * Authorization
     * Requires a user access token that includes the channel:manage:ads scope. The user_id in the user access token must match the
     * broadcaster_id.
     *
     * @param string               $broadcasterId Provided broadcaster_id must match the user_id in the auth token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function snoozeNextAd(
        string $broadcasterId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/ads/schedule/snooze',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }
}
