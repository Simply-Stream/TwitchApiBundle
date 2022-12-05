<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use RuntimeException;
use SimplyStream\TwitchApiBundle\Helix\Dto\Game;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponse;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;

class GamesApi extends AbstractApi
{
    /**
     * Gets information about all broadcasts on Twitch.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string|null               $after  The cursor used to get the next page of results. The Pagination object in the response
     *                                          contains the cursor’s value.
     * @param string|null               $before The cursor used to get the previous page of results. The Pagination object in the response
     *                                          contains the cursor’s value.
     * @param int                       $first  The maximum number of items to return per page in the response. The minimum page size is 1
     *                                          item per page and the maximum is 100 items per page. The default is 20.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponse
     * @throws \JsonException
     */
    public function getTopGames(
        string $after = null,
        string $before = null,
        int $first = 20,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: 'games/top',
            query: ['after' => $after, 'before' => $before, 'first' => $first],
            type: 'array<' . Game::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets information about specified categories or games.
     *
     * You may get up to 100 categories or games by specifying their ID or name. You may specify all IDs, all names, or a combination of
     * IDs and names. If you specify a combination of IDs and names, the total number of IDs and names must not exceed 100.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param array<string>             $id      The ID of the category or game to get. Include this parameter for each category or
     *                                           game you want to get. For example, &id=1234&id=5678. You may specify a maximum of 100 IDs.
     *                                           The endpoint ignores duplicate and invalid IDs or IDs that weren’t found.
     * @param array<string>             $name    The name of the category or game to get. The name must exactly match the
     *                                           category’s or game’s title. Include this parameter for each category or game you want to
     *                                           get. For example, &name=foo&name=bar. You may specify a maximum of 100 names. The endpoint
     *                                           ignores duplicate names and names that weren’t found.
     * @param array<string>             $igdbId  The IGDB ID of the game to get. Include this parameter for each game you want to get.
     *                                           For example, &igdb_id=1234&igdb_id=5678. You may specify a maximum of 100 IDs. The
     *                                           endpoint ignores duplicate and invalid IDs or IDs that weren’t found.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getGames(array $id = [], array $name = [], array $igdbId = [], AccessTokenInterface $accessToken = null):
    TwitchResponseInterface {
        if ((count($id) + count($name) + count($igdbId)) > 100) {
            throw new RuntimeException('You cannot search for more than 100 ids or games');
        }

        if (empty($id) && empty($name) && empty($igdbId)) {
            throw new RuntimeException('You need at least one id, game or IGDB ID to request');
        }

        return $this->sendRequest(
            path: 'games',
            query: [
                'id' => $id,
                'name' => $name,
                'igdb_id' => $igdbId,
            ],
            type: 'array<' . Game::class . '>',
            accessToken: $accessToken
        );
    }
}
