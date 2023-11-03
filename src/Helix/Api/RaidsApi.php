<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\Raids\Raid;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class RaidsApi extends AbstractApi
{
    protected const BASE_PATH = 'raids';

    /**
     * Raid another channel by sending the broadcaster’s viewers to the targeted channel.
     *
     * When you call the API from a chat bot or extension, the Twitch UX pops up a window at the top of the chat room that identifies the
     * number of viewers in the raid. The raid occurs when the broadcaster clicks Raid Now or after the 90-second countdown expires.
     *
     * To determine whether the raid successfully occurred, you must subscribe to the Channel Raid event. For more information, see Get
     * notified when a raid begins.
     *
     * To cancel a pending raid, use the Cancel a raid endpoint.
     *
     * Rate Limit: The limit is 10 requests within a 10-minute window.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:raids scope.
     *
     * @param string               $fromBroadcasterId The ID of the broadcaster that’s sending the raiding party. This ID must match the
     *                                                user ID associated with the user access token.
     * @param string               $toBroadcasterId   The ID of the broadcaster to raid.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchDataResponse<Raid[]>
     * @throws \JsonException
     */
    public function startRaid(
        string $fromBroadcasterId,
        string $toBroadcasterId,
        AccessTokenInterface $accessToken
    ): TwitchDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'from_broadcaster_id' => $fromBroadcasterId,
                'to_broadcaster_id' => $toBroadcasterId,
            ],
            type: sprintf('%s<%s[]>', TwitchDataResponse::class, Raid::class),
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * Cancel a pending raid.
     *
     * You can cancel a raid at any point up until the broadcaster clicks Raid Now in the Twitch UX or the 90-second countdown expires.
     *
     * Rate Limit: The limit is 10 requests within a 10-minute window.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:raids scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that initiated the raid. This ID must match the user ID
     *                                            associated with the user access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function cancelRaid(
        string $broadcasterId,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }
}
