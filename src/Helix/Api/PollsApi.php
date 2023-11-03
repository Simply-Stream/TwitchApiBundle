<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\Polls\CreatePollRequest;
use SimplyStream\TwitchApiBundle\Helix\Models\Polls\EndPollRequest;
use SimplyStream\TwitchApiBundle\Helix\Models\Polls\Poll;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchPaginatedDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class PollsApi extends AbstractApi
{
    protected const BASE_PATH = 'polls';

    /**
     * Gets a list of polls that the broadcaster created.
     *
     * Polls are available for 90 days after they’re created.
     *
     * Authorization:
     * Requires a user access token that includes the channel:read:polls scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that created the polls. This ID must match the user ID in the
     *                                            user access token.
     * @param AccessTokenInterface $accessToken
     * @param string|null          $id            A list of IDs that identify the polls to return. To specify more than one ID, include
     *                                            this parameter for each poll you want to get. For example, id=1234&id=5678. You may
     *                                            specify a maximum of 20 IDs.
     *
     *                                            Specify this parameter only if you want to filter the list that the request returns. The
     *                                            endpoint ignores duplicate IDs and thosenot owned by this broadcaster.
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 20 items per page. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchPaginatedDataResponse<Poll[]>
     * @throws \JsonException
     */
    public function getPolls(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        string $id = null,
        int $first = 20,
        string $after = null
    ): TwitchPaginatedDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'id' => $id,
                'first' => $first,
                'after' => $after,
            ],
            type: sprintf('%s<%s[]>', TwitchPaginatedDataResponse::class, Poll::class),
            accessToken: $accessToken
        );
    }

    /**
     * Creates a poll that viewers in the broadcaster’s channel can vote on.
     *
     * The poll begins as soon as it’s created. You may run only one poll at a time.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:polls scope.
     *
     * @param CreatePollRequest    $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchDataResponse<Poll[]>
     * @throws \JsonException
     */
    public function createPoll(
        CreatePollRequest $body,
        AccessTokenInterface $accessToken
    ): TwitchDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH,
            type: sprintf('%s<%s[]>', TwitchDataResponse::class, Poll::class),
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Ends an active poll. You have the option to end it or end it and archive it.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:polls scope.
     *
     * @param EndPollRequest       $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchDataResponse<Poll[]>
     * @throws \JsonException
     */
    public function endPoll(
        EndPollRequest $body,
        AccessTokenInterface $accessToken
    ): TwitchDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH,
            type: sprintf('%s<%s[]>', TwitchDataResponse::class, Poll::class),
            method: Request::METHOD_PATCH,
            body: $body,
            accessToken: $accessToken
        );
    }
}
