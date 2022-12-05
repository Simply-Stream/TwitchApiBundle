<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;

class MusicApi extends AbstractApi
{
    protected const BASE_PATH = 'soundtrack';

    /**
     * Gets the Soundtrack track that the broadcaster is playing.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $broadcasterId The ID of the broadcaster that’s playing a Soundtrack track.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getSoundtrackCurrentTrack(string $broadcasterId, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/current_track',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the Soundtrack playlist’s tracks.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $id    The ID of the playlist to get.
     * @param int                       $first The maximum number of items to return per page in the response. The minimum page size is 1
     *                                         item per page and the maximum is 50 items per page. The default is 20.
     * @param string|null               $after The cursor used to get the next page of results. The Pagination object in the response
     *                                         contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getSoundtrackPlaylist(
        string $id,
        int $first = 20,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/playlist',
            query: [
                'id' => $id,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of Soundtrack playlists.
     *
     * The response contains information about the playlists, such as their titles and descriptions. To get a playlist’s tracks, use Get
     * Soundtrack Playlist endpoint.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $id    The ID of the playlist to get. Specify an ID only if you want to get a single playlist
     *                                         instead of all playlists.
     * @param int                       $first The maximum number of items to return per page in the response. The minimum page size is 1
     *                                         item per page and the maximum is 50 items per page. The default is 20.
     * @param string|null               $after The cursor used to get the next page of results. The Pagination object in the response
     *                                         contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getSoundtrackPlaylists(
        string $id,
        int $first = 20,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/playlists',
            query: [
                'id' => $id,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }
}
