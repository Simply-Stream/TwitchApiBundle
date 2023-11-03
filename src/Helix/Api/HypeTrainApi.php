<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\HypeTrain\HypeTrainEvent;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchPaginatedDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;

class HypeTrainApi extends AbstractApi
{
    protected const BASE_PATH = 'hypetrain';

    /**
     * Gets information about the broadcaster’s current or most recent Hype Train event.
     *
     * Instead of polling for events, consider subscribing to Hype Train events (Begin, Progress, End).
     *
     * Authentication:
     * Requires a user access token that includes the channel:read:hype_train scope.
     *
     * @param string                    $broadcasterId The ID of the broadcaster that’s running the Hype Train. This ID must match the User
     *                                                 ID in the user access token.
     * @param AccessTokenInterface|null $accessToken
     * @param int                       $first         The maximum number of items to return per page in the response. The minimum page
     *                                                 size is 1 item per page and the maximum is 100 items per page. The default is 1.
     * @param string|null               $after         The cursor used to get the next page of results. The Pagination object in the
     *                                                 response contains the cursor’s value.
     *
     * @return TwitchPaginatedDataResponse<HypeTrainEvent[]>
     * @throws \JsonException
     */
    public function getHypeTrainEvents(
        string $broadcasterId,
        AccessTokenInterface $accessToken = null,
        int $first = 1,
        string $after = null,
    ): TwitchPaginatedDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/events',
            query: [
                'broadcaster_id' => $broadcasterId,
                'first' => $first,
                'after' => $after,
            ],
            type: sprintf('%s<%s[]>', TwitchPaginatedDataResponse::class, HypeTrainEvent::class),
            accessToken: $accessToken
        );
    }
}
