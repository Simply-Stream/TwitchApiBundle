<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use DateTime;
use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\StreamSchedule;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class ScheduleApi extends AbstractApi
{
    protected const BASE_PATH = 'schedule';

    /**
     * Gets the broadcaster’s streaming schedule. You can get the entire schedule or specific segments of the schedule. Learn More
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $broadcasterId The ID of the broadcaster that owns the streaming schedule you want to get.
     * @param string|null               $id            The ID of the scheduled segment to return. To specify more than one segment, include
     *                                                 the ID of each segment you want to get. For example, id=1234&id=5678. You may
     *                                                 specify a maximum of 100 IDs.
     * @param \DateTime|null            $starTime      The UTC date and time that identifies when in the broadcaster’s schedule to start
     *                                                 returning segments. If not specified, the request returns segments starting after
     *                                                 the current UTC date and time. Specify the date and time in RFC3339 format (for
     *                                                 example, 2022-09-01T00:00:00Z).
     * @param string|null               $utcOffset     Not supported.
     * @param int                       $first         The maximum number of items to return per page in the response. The minimum page
     *                                                 size is 1 item per page and the maximum is 25 items per page. The default is 20.
     * @param string|null               $after         The cursor used to get the next page of results. The Pagination object in the
     *                                                 response contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChannelStreamSchedule(
        string $broadcasterId,
        string $id = null,
        \DateTime $starTime = null,
        string $utcOffset = null,
        int $first = 20,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'id' => $id,
                'start_time' => $starTime?->format(DATE_RFC3339),
                // 'utc_offset' => $utcOffset // Not supported, don't ask why they even noted it in their documentation ...
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the broadcaster’s streaming schedule as an iCalendar.
     *
     * Authorization:
     * The Client-Id and Authorization headers are not required.
     *
     * @param string $broadcasterId The ID of the broadcaster that owns the streaming schedule you want to get.
     *
     * @TODO: This might not work. The response from this request is an unstructured text/html mimetype
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChanelICalendar(
        string $broadcasterId
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/icalendar',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'string',
        );
    }

    /**
     * Updates the broadcaster’s schedule settings, such as scheduling a vacation.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:schedule scope.
     *
     * @param string               $broadcasterId     The ID of the broadcaster whose schedule settings you want to update. The ID must
     *                                                match the user ID in the user access token.
     * @param AccessTokenInterface $accessToken
     * @param bool                 $isVacationEnabled A Boolean value that indicates whether the broadcaster has scheduled a vacation. Set
     *                                                to true to enable Vacation Mode and add vacation dates, or false to cancel a
     *                                                previously scheduled vacation.
     * @param DateTime|null        $vacationStartTime The UTC date and time of when the broadcaster’s vacation starts. Specify the date and
     *                                                time in RFC3339 format (for example, 2021-05-16T00:00:00Z). Required if
     *                                                is_vacation_enabled is true.
     * @param DateTime|null        $vacationEndTime   The UTC date and time of when the broadcaster’s vacation ends. Specify the date and
     *                                                time in RFC3339 format (for example, 2021-05-30T23:59:59Z). Required if
     *                                                is_vacation_enabled is true.
     * @param string|null          $timezone          The time zone that the broadcaster broadcasts from. Specify the time zone using IANA
     *                                                time zone database format (for example, America/New_York). Required if
     *                                                is_vacation_enabled is true.
     *
     * @return void
     * @throws \JsonException
     */
    public function updateChannelStreamSchedule(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        bool $isVacationEnabled = false,
        DateTime $vacationStartTime = null,
        DateTime $vacationEndTime = null,
        string $timezone = null,
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                'is_vacation_enabled' => $isVacationEnabled,
                'vacation_start_time' => $vacationStartTime?->format(DATE_RFC3339),
                'vacation_end_time' => $vacationEndTime?->format(DATE_RFC3339),
                'timezone' => $timezone,
            ],
            method: Request::METHOD_PATCH,
            accessToken: $accessToken
        );
    }

    /**
     * Adds a single or recurring broadcast to the broadcaster’s streaming schedule. For information about scheduling broadcasts, see
     * Stream Schedule.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:schedule scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the schedule to add the broadcast segment to. This ID
     *                                            must match the user ID in the user access token.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function createStreamScheduleSegment(
        string $broadcasterId,
        array $body,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/segment',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: StreamSchedule::class,
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Updates a scheduled broadcast segment.
     *
     * For recurring segments, updating a segment’s title, category, duration, and timezone, changes all segments in the recurring
     * schedule, not just the specified segment.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:schedule scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster who owns the broadcast segment to update. This ID must match
     *                                            the user ID in the user access token.
     * @param string               $id            The ID of the broadcast segment to update.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function updateStreamScheduleSegment(
        string $broadcasterId,
        string $id,
        array $body,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/segment',
            query: [
                'broadcaster_id' => $broadcasterId,
                'id' => $id,
            ],
            type: StreamSchedule::class,
            method: Request::METHOD_PATCH,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Removes a broadcast segment from the broadcaster’s streaming schedule.
     *
     * NOTE: For recurring segments, removing a segment removes all segments in the recurring schedule.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:schedule scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the streaming schedule. This ID must match the user
     *                                            ID in the user access token.
     * @param string               $id            The ID of the broadcast segment to remove.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function deleteStreamScheduleSegment(
        string $broadcasterId,
        string $id,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/segment',
            query: [
                'broadcaster_id' => $broadcasterId,
                'id' => $id,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }
}
