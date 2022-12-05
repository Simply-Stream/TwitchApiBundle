<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\Subscription;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;

class SubscriptionsApi extends AbstractApi
{
    protected const BASE_PATH = 'subscriptions';

    /**
     * Gets a list of users that subscribe to the specified broadcaster.
     *
     * Authentication:
     * Requires a user access token that includes the channel:read:subscriptions scope.
     *
     * A Twitch extensions may use an app access token if the broadcaster has granted the channel:read:subscriptions scope from within the
     * Twitch Extensions manager.
     *
     * @param string                    $broadcasterId The broadcaster’s ID. This ID must match the user ID in the access token.
     * @param string|null               $userId        Filters the list to include only the specified subscribers. To specify more than one
     *                                                 subscriber, include this parameter for each subscriber. For example,
     *                                                 &user_id=1234&user_id=5678. You may specify a maximum of 100 subscribers.
     * @param int                       $first         The maximum number of items to return per page in the response. The minimum page
     *                                                 size is 1 item per page and the maximum is 100 items per page. The default is 20.
     * @param string|null               $after         The cursor used to get the next page of results. Do not specify if you set the
     *                                                 user_id query parameter. The Pagination object in the response contains the cursor’s
     *                                                 value.
     * @param string|null               $before        The cursor used to get the previous page of results. Do not specify if you set the
     *                                                 user_id query parameter. The Pagination object in the response contains the cursor’s
     *                                                 value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getBroadcasterSubscriptions(
        string $broadcasterId,
        string $userId = null,
        int $first = 20,
        string $after = null,
        string $before = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
                'first' => $first,
                'before' => $before,
                'after' => $after,
            ],
            type: 'array<' . Subscription::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Checks whether the user subscribes to the broadcaster’s channel.
     *
     * Authentication:
     * Requires a user access token that includes the user:read:subscriptions scope.
     *
     * A Twitch extensions may use an app access token if the broadcaster has granted the user:read:subscriptions scope from within the
     * Twitch Extensions manager.
     *
     * @param string               $broadcasterId The ID of a partner or affiliate broadcaster.
     * @param string               $userId        The ID of the user that you’re checking to see whether they subscribe to the broadcaster
     *                                            in broadcaster_id. This ID must match the user ID in the access Token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function checkUserSubscription(string $broadcasterId, string $userId, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }
}
