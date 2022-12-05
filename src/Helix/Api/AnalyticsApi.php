<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\ExtensionReport;
use SimplyStream\TwitchApiBundle\Helix\Dto\GameReport;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;

class AnalyticsApi extends AbstractApi
{
    protected const BASE_PATH = 'analytics';

    /**
     * Gets an analytics report for one or more extensions. The response contains the URLs used to download the reports (CSV files).
     *
     * Authentication:
     * Requires a user access token that includes the analytics:read:extensions scope.
     *
     * @param AccessTokenInterface $accessToken
     * @param string|null          $extensionId      The extension’s client ID. If specified, the response contains a report for the
     *                                               specified extension. If not specified, the response includes a report for each
     *                                               extension that the authenticated user owns.
     * @param string|null          $type             The type of analytics report to get. Possible values are: overview_v2
     * @param \DateTime|null       $startedAt        The reporting window’s start date, in RFC3339 format. Set the time portion to zeroes
     *                                               (for example, 2021-10-22T00:00:00Z).
     *
     *                                               The start date must be on or after January 31, 2018. If you specify an earlier date,
     *                                               the API ignores it and uses January 31, 2018. If you specify a start date, you must
     *                                               specify an end date. If you don’t specify a start and end date, the report includes
     *                                               all available data since January 31, 2018.
     *
     *                                               The report contains one row of data for each day in the reporting window.
     * @param \DateTime|null       $endedAt          The reporting window’s end date, in RFC3339 format. Set the time portion to zeroes
     *                                               (for example, 2021-10-27T00:00:00Z). The report is inclusive of the end date.
     *
     *                                               Specify an end date only if you provide a start date. Because it can take up to two
     *                                               days for the data to be available, you must specify an end date that’s earlier than
     *                                               today minus one to two days. If not, the API ignores your end date and uses an end
     *                                               date that is today minus one to two days.
     * @param int                  $first            The maximum number of report URLs to return per page in the response. The minimum page
     *                                               size is 1 URL per page and the maximum is 100 URLs per page. The default is 20.
     *
     *                                               NOTE: While you may specify a maximum value of 100, the response will contain at
     *                                               most 20 URLs per page.
     * @param string|null          $after            The cursor used to get the next page of results. The Pagination object in the response
     *                                               contains the cursor’s value.
     *
     * This parameter is ignored if the extension_id parameter is set.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getExtensionAnalytics(
        AccessTokenInterface $accessToken,
        string $extensionId = null,
        string $type = null,
        \DateTime $startedAt = null,
        \DateTime $endedAt = null,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/extensions',
            query: [
                'extension_id' => $extensionId,
                'type' => $type,
                'started_at' => $startedAt?->format(DATE_RFC3339),
                'ended_at' => $endedAt?->format(DATE_RFC3339),
                'first' => $first,
                'after' => $after,
            ],
            type: 'array<' . ExtensionReport::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets an analytics report for one or more games. The response contains the URLs used to download the reports (CSV files).
     *
     * Authentication:
     * Requires a user access token that includes the analytics:read:games scope.
     *
     * @param AccessTokenInterface $accessToken
     * @param string|null          $gameId         The game’s client ID. If specified, the response contains a report for the specified
     *                                             game. If not specified, the response includes a report for each of the authenticated
     *                                             user’s games.
     * @param string|null          $type           The type of analytics report to get. Possible values are: overview_v2
     * @param \DateTime|null       $startedAt      The reporting window’s start date, in RFC3339 format. Set the time portion to zeroes
     *                                             (for example,
     *                                             2021-10-22T00:00:00Z). If you specify a start date, you must specify an end date.
     *
     *                                  The start date must be within one year of today’s date. If you specify an earlier date, the API
     *                                  ignores it and uses a date that’s one year prior to today’s date. If you don’t specify a start and
     *                                  end date, the report includes all available data for the last 365 days from today.
     *
     *                                  The report contains one row of data for each day in the reporting window.
     * @param \DateTime|null       $endedAt        The reporting window’s end date, in RFC3339 format. Set the time portion to zeroes (for
     *                                             example,
     *                                             2021-10-22T00:00:00Z). The report is inclusive of the end date.
     *
     *                                  Specify an end date only if you provide a start date. Because it can take up to two days for the
     *                                  data to be available, you must specify an end date that’s earlier than today minus one to two days.
     *                                  If not, the API ignores your end date and uses an end date that is today minus one to two days.
     * @param int                  $first          The maximum number of report URLs to return per page in the response. The minimum page
     *                                             size is 1 URL per page and the maximum is 100 URLs per page. The default is 20.
     *
     *                                  NOTE: While you may specify a maximum value of 100, the response will contain at most 20 URLs per
     *                                  page.
     * @param string|null          $after          The cursor used to get the next page of results. The Pagination object in the response
     *                                             contains the cursor’s value.
     *
     *                                  This parameter is ignored if game_id parameter is set.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getGameAnalytics(
        AccessTokenInterface $accessToken,
        string $gameId = null,
        string $type = null,
        \DateTime $startedAt = null,
        \DateTime $endedAt = null,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/games',
            query: [
                'game_id' => $gameId,
                'type' => $type,
                'started_at' => $startedAt?->format(DATE_RFC3339),
                'ended_at' => $endedAt?->format(DATE_RFC3339),
                'first' => $first,
                'after' => $after,
            ],
            type: 'array<' . GameReport::class . '>',
            accessToken: $accessToken
        );
    }
}
