<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\Streams\CreateStreamMarkerRequest;
use SimplyStream\TwitchApiBundle\Helix\Models\Streams\Stream;
use SimplyStream\TwitchApiBundle\Helix\Models\Streams\StreamKey;
use SimplyStream\TwitchApiBundle\Helix\Models\Streams\StreamMarker;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchPaginatedDataResponse;
use Symfony\Component\HttpFoundation\Request;

class StreamsApi extends AbstractApi
{
    protected const BASE_PATH = 'streams';

    /**
     * Gets the channel’s stream key.
     *
     * Authentication:
     * Requires a user access token that includes the channel:read:stream_key scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the channel. The ID must match the user ID in the
     *                                            access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchDataResponse<StreamKey[]>
     * @throws \JsonException
     */
    public function getStreamKey(
        string $broadcasterId,
        AccessTokenInterface $accessToken
    ): TwitchDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/key',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: sprintf('%s<%s[]>', TwitchDataResponse::class, StreamKey::class),
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of all broadcasters that are streaming. The list is in descending order by the number of viewers watching the stream.
     * Because viewers come and go during a stream, it’s possible to find duplicate or missing streams in the list as you page through the
     * results.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param array|null                $userId    A user ID used to filter the list of streams. Returns only the streams of those users
     *                                             that are broadcasting. You may specify a maximum of 100 IDs. To specify multiple IDs,
     *                                             include the user_id parameter for each user. For example, &user_id=1234&user_id=5678.
     * @param array|null                $userLogin A user login name used to filter the list of streams. Returns only the streams of those
     *                                             users that are broadcasting. You may specify a maximum of 100 login names. To specify
     *                                             multiple names, include the user_login parameter for each user. For example,
     *                                             &user_login=foo&user_login=bar.
     * @param string|null               $gameId    A game (category) ID used to filter the list of streams. Returns only the streams that
     *                                             are broadcasting the game (category). You may specify a maximum of 100 IDs. To specify
     *                                             multiple IDs, include the game_id parameter for each game. For example,
     *                                             &game_id=9876&game_id=5432.
     * @param string                    $type      The type of stream to filter the list of streams by. Possible values are:
     *                                             - all
     *                                             - live
     *                                             The default is all.
     * @param string|null               $language  A language code used to filter the list of streams. Returns only streams that broadcast
     *                                             in the specified language. Specify the language using an ISO 639-1 two-letter language
     *                                             code or other if the broadcast uses a language not in the list of supported stream
     *                                             languages.
     *
     *                                             You may specify a maximum of 100 language codes. To specify multiple languages, include
     *                                             the language parameter for each language. For example, &language=de&language=fr.
     * @param int                       $first     The maximum number of items to return per page in the response. The minimum page size is
     *                                             1 item per page and the maximum is 100 items per page. The default is 20.
     * @param string|null               $before    The cursor used to get the previous page of results. The Pagination object in the
     *                                             response contains the cursor’s value.
     * @param string|null               $after     The cursor used to get the next page of results. The Pagination object in the response
     *                                             contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchPaginatedDataResponse<Stream[]>
     * @throws MappingError
     * @throws \JsonException
     */
    public function getStreams(
        array $userId = [],
        array $userLogin = [],
        string $gameId = null,
        string $type = 'all',
        string $language = null,
        int $first = 20,
        string $before = null,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): TwitchPaginatedDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'user_id' => $userId,
                'user_login' => $userLogin,
                'game_id' => $gameId,
                'type' => $type,
                'language' => $language,
                'first' => $first,
                'before' => $after,
                'after' => $before,
            ],
            type: sprintf('%s<%s[]>', TwitchPaginatedDataResponse::class, Stream::class),
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of live streams of broadcasters that the specified user follows.
     *
     * Authentication:
     * Requires a user access token that includes the user:read:follows scope.
     *
     * @param string               $userId The ID of the user whose list of followed streams you want to get. This ID must match the user
     *                                     ID in the access token.
     * @param AccessTokenInterface $accessToken
     * @param int                  $first  The maximum number of items to return per page in the response. The minimum page size is 1 item
     *                                     per page and the maximum is 100 items per page. The default is 100.
     * @param string|null          $after  The cursor used to get the next page of results. The Pagination object in the response contains
     *                                     the cursor’s value.
     *
     * @return TwitchPaginatedDataResponse<Stream[]>
     * @throws \JsonException
     */
    public function getFollowedStreams(
        string $userId,
        AccessTokenInterface $accessToken,
        int $first = 100,
        string $after = null
    ): TwitchPaginatedDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/followed',
            query: [
                'user_id' => $userId,
                'first' => $first,
                'after' => $after,
            ],
            type: sprintf('%s<%s[]>', TwitchPaginatedDataResponse::class, Stream::class),
            accessToken: $accessToken
        );
    }

    /**
     * Adds a marker to a live stream. A marker is an arbitrary point in a live stream that the broadcaster or editor wants to mark, so
     * they can return to that spot later to create video highlights (see Video Producer, Highlights in the Twitch UX).
     *
     * You may not add markers:
     *
     * - If the stream is not live
     * - If the stream has not enabled video on demand (VOD)
     * - If the stream is a premiere (a live, first-viewing event that combines uploaded videos with live chat)
     * - If the stream is a rerun of a past broadcast, including past premieres.
     *
     * Authentication:
     * Requires a user access token that includes the channel:manage:broadcast scope.
     *
     * @param CreateStreamMarkerRequest $body
     * @param AccessTokenInterface      $accessToken
     *
     * @return TwitchDataResponse<StreamMarker[]>
     * @throws \JsonException
     */
    public function createStreamMarker(
        CreateStreamMarkerRequest $body,
        AccessTokenInterface $accessToken
    ): TwitchDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/markers',
            type: sprintf('%s<%s[]>', TwitchDataResponse::class, StreamMarker::class),
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of markers from the user’s most recent stream or from the specified VOD/video. A marker is an arbitrary point in a live
     * stream that the broadcaster or editor marked, so they can return to that spot later to create video highlights (see Video Producer,
     * Highlights in the Twitch UX).
     *
     * Authentication:
     * Requires a user access token that includes the user:read:broadcast scope.
     *
     * @param string               $userId  A user ID. The request returns the markers from this user’s most recent video. This ID must
     *                                      match the user ID in the access token or the user in the access token must be one of the
     *                                      broadcaster’s editors.
     *
     *                                      This parameter and the video_id query parameter are mutually exclusive.
     * @param string               $videoId A video on demand (VOD)/video ID. The request returns the markers from this VOD/video. The user
     *                                      in the access token must own the video or the user must be one of the broadcaster’s editors.
     *
     *                                      This parameter and the user_id query parameter are mutually exclusive.
     * @param AccessTokenInterface $accessToken
     * @param int                  $first   The maximum number of items to return per page in the response. The minimum page size is 1 item
     *                                      per page and the maximum is 100 items per page. The default is 20.
     * @param string|null          $before  The cursor used to get the previous page of results. The Pagination object in the response
     *                                      contains the cursor’s value.
     * @param string|null          $after   The cursor used to get the next page of results. The Pagination object in the response contains
     *                                      the cursor’s value.
     *
     * @return TwitchPaginatedDataResponse<StreamMarker[]>
     * @throws \JsonException
     */
    public function getStreamMarkers(
        string $userId,
        string $videoId,
        AccessTokenInterface $accessToken,
        int $first = 20,
        string $before = null,
        string $after = null
    ): TwitchPaginatedDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/markers',
            query: [
                'user_id' => $userId,
                'video_id' => $videoId,
                'first' => $first,
                'before' => $before,
                'after' => $after,
            ],
            type: sprintf('%s<%s[]>', TwitchPaginatedDataResponse::class, StreamMarker::class),
            accessToken: $accessToken
        );
    }
}
