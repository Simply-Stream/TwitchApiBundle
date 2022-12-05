<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\Game;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;

class SearchApi extends AbstractApi
{
    protected const BASE_PATH = 'search';

    /**
     * Gets the games or categories that match the specified query.
     *
     * To match, the category’s name must contain all parts of the query string. For example, if the query string is 42, the response
     * includes any category name that contains 42 in the title. If the query string is a phrase like love computer, the response includes
     * any category name that contains the words love and computer anywhere in the name. The comparison is case insensitive.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string                    $query The URI-encoded search string. For example, encode #archery as %23archery and search strings
     *                                         like angel of death as angel%20of%20death.
     * @param int                       $first The maximum number of items to return per page in the response. The minimum page size is 1
     *                                         item per page and the maximum is 100 items per page. The default is 20.
     * @param string|null               $after The cursor used to get the next page of results. The Pagination object in the response
     *                                         contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function searchCategories(
        string $query,
        int $first = 20,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/categories',
            query: [
                'query' => $query,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array<' . Game::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the channels that match the specified query and have streamed content within the past 6 months.
     *
     * The fields that the API uses for comparison depends on the value that the live_only query parameter is set to. If live_only is
     * false, the API matches on the broadcaster’s login name. However, if live_only is true, the API matches on the broadcaster’s name and
     * category name.
     *
     * To match, the beginning of the broadcaster’s name or category must match the query string. The comparison is case insensitive. If
     * the query string is angel_of_death, it matches all names that begin with angel_of_death. However, if the query string is a phrase
     * like angel of death, it matches to names starting with angelofdeath or names starting with angel_of_death.
     *
     * By default, the results include both live and offline channels. To get only live channels set the live_only query parameter to true.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string                    $query    The URI-encoded search string. For example, encode search strings like angel of death as
     *                                            angel%20of%20death.
     * @param bool                      $liveOnly A Boolean value that determines whether the response includes only channels that are
     *                                            currently streaming live. Set to true to get only channels that are streaming live;
     *                                            otherwise, false to get live and offline channels. The default is false.
     * @param int                       $first    The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100 items per page. The default is 20.
     * @param string|null               $after    The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function searchChannels(
        string $query,
        bool $liveOnly = false,
        int $first = 20,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/categories',
            query: [
                'query' => $query,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }
}
