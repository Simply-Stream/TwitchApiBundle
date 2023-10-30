<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\Clip;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class ClipsApi extends AbstractApi
{
    protected const BASE_PATH = 'clips';

    /**
     * Creates a clip from the broadcaster’s stream.
     *
     * This API captures up to 90 seconds of the broadcaster’s stream. The 90 seconds spans the point in the stream from when you called
     * the API. For example, if you call the API at the 4:00 minute mark, the API captures from approximately the 3:35 mark to
     * approximately the 4:05 minute mark. Twitch tries its best to capture 90 seconds of the stream, but the actual length may be less.
     * This may occur if you begin capturing the clip near the beginning or end of the stream.
     *
     * By default, Twitch publishes up to the last 30 seconds of the 90 seconds window and provides a default title for the clip. To
     * specify the title and the portion of the 90 seconds window that’s used for the clip, use the URL in the response’s edit_url field.
     * You can specify a clip that’s from 5 seconds to 60 seconds in length. The URL is valid for up to 24 hours or until the clip is
     * published, whichever comes first.
     *
     * Creating a clip is an asynchronous process that can take a short amount of time to complete. To determine whether the clip was
     * successfully created, call Get Clips using the clip ID that this request returned. If Get Clips returns the clip, the clip was
     * successfully created. If after 15 seconds Get Clips hasn’t returned the clip, assume it failed.
     *
     * Authentication:
     * Requires a user access token that includes the clips:edit scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose stream you want to create a clip from.
     * @param AccessTokenInterface $accessToken
     * @param bool                 $hasDelay      A Boolean value that determines whether the API captures the clip at the moment the
     *                                            viewer requests it or after a delay. If false (default), Twitch captures the clip at the
     *                                            moment the viewer requests it (this is the same clip experience as the Twitch UX). If
     *                                            true, Twitch adds a delay before capturing the clip (this basically shifts the capture
     *                                            window to the right slightly).
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function createClip(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        bool $hasDelay = false
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'has_delay' => $hasDelay,
            ],
            type: 'array',
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * Gets one or more video clips that were captured from streams. For information about clips, see How to use clips.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string|null               $broadcasterId An ID that identifies the broadcaster whose video clips you want to get. Use this
     *                                                 parameter to get clips that were captured from the broadcaster’s streams.
     * @param string|null               $gameId        An ID that identifies the game whose clips you want to get. Use this parameter to
     *                                                 get clips that were captured from streams that were playing this game.
     * @param string|null               $id            An ID that identifies the clip to get. To specify more than one ID, include this
     *                                                 parameter for each clip you want to get. For example, id=foo&id=bar. You may specify
     *                                                 a maximum of 100 IDs. The API ignores duplicate IDs and IDs that aren’t found.
     * @param \DateTime|null            $startedAt     The start date used to filter clips. The API returns only clips within the start and
     *                                                 end date window. Specify the date and time in RFC3339 format.
     * @param \DateTime|null            $endedAt       The end date used to filter clips. If not specified, the time window is the start
     *                                                 date plus one week. Specify the date and time in RFC3339 format.
     * @param int                       $first         The maximum number of clips to return per page in the response. The minimum page
     *                                                 size is 1 clip per page and the maximum is 100. The default is 20.
     * @param string|null               $before        The cursor used to get the previous page of results. The Pagination object in the
     *                                                 response contains the cursor’s value.
     * @param string|null               $after         The cursor used to get the next page of results. The Pagination object in the
     *                                                 response contains the cursor’s value.
     * @param bool|null                 $isFeatured
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getClips(
        string $broadcasterId = null,
        string $gameId = null,
        string $id = null,
        \DateTime $startedAt = null,
        \DateTime $endedAt = null,
        int $first = 20,
        string $before = null,
        string $after = null,
        bool $isFeatured = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        if (! $broadcasterId && ! $gameId && ! $id) {
            throw new \RuntimeException('You need to specify at least one kind of ID');
        }

        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'game_id' => $gameId,
                'id' => $id,
                'started_at' => $startedAt?->format(DATE_RFC3339),
                'ended_at' => $endedAt?->format(DATE_RFC3339),
                'after' => $after,
                'before' => $before,
                'first' => $first,
                'is_featured' => $isFeatured
            ],
            type: Clip::class . '[]',
            accessToken: $accessToken
        );
    }
}
