<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\Channels\ChannelEditor;
use SimplyStream\TwitchApiBundle\Helix\Models\Channels\ChannelFollow;
use SimplyStream\TwitchApiBundle\Helix\Models\Channels\ChannelInformation;
use SimplyStream\TwitchApiBundle\Helix\Models\Channels\FollowedChannel;
use SimplyStream\TwitchApiBundle\Helix\Models\Channels\ModifyChannelInformationRequest;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchPaginatedDataResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class ChannelsApi extends AbstractApi
{
    protected const BASE_PATH = 'channels';

    /**
     * Gets information about one or more channels.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param array                     $broadcasterId The ID of the broadcaster whose channel you want to get. To specify more than one
     *                                                 ID, include this parameter for each broadcaster you want to get. For example,
     *                                                 broadcaster_id=1234&broadcaster_id=5678. You may specify a maximum of 100 IDs. The
     *                                                 API ignores duplicate IDs and IDs that are not found.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchDataResponse<ChannelInformation[]>
     * @throws \JsonException
     */
    public function getChannelInformation(
        array $broadcasterId,
        AccessTokenInterface $accessToken = null
    ): TwitchDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId
            ],
            type: sprintf('%s<%s[]>', TwitchDataResponse::class, ChannelInformation::class),
            accessToken: $accessToken
        );
    }

    /**
     * Updates a channel’s properties.
     *
     * Authentication:
     * Requires a user access token that includes the channel:manage:broadcast scope.
     *
     * @param string                          $broadcasterId The ID of the broadcaster whose channel you want to update. This ID must match
     *                                                       the user ID associated with the user access token.
     * @param ModifyChannelInformationRequest $body
     *                                                       - game_id                         String    No    The ID of the game that the
     *                                                       user plays. The game is not updated if the ID isn’t a game ID that Twitch
     *                                                       recognizes. To unset this field, use
     *                                                       “0” or “” (an empty string).
     *                                                       - broadcaster_language            String    No    The user’s
     *                                                       preferred language. Set the value to an ISO 639-1 two-letter language code
     *                                                       (for
     *                                                       example, en for English). Set to “other” if the user’s preferred language is
     *                                                       not a Twitch supported language. The language isn’t updated if the language
     *                                                       code isn’t a Twitch supported language.
     *                                                       - title                           String    No    The title of the user’s
     *                                                       stream. You may not set this field to an empty string.
     *                                                       - delay                           Integer   No    The number of seconds you
     *                                                       want your broadcast buffered before streaming it live. The delay helps ensure
     *                                                       fairness during competitive play. Only users with Partner status may set this
     *                                                       field. The maximum delay is
     *                                                       900 seconds (15 minutes).
     *                                                       - tags                            String[]  No    A list of channel-defined
     *                                                       tags to apply to the channel. To remove all tags from the channel, set tags to
     *                                                       an empty array. Tags help identify the content that the channel streams. Learn
     *                                                       More A channel may specify a maximum of 10 tags. Each tag is limited to a
     *                                                       maximum of 25 characters and may not be an empty string or contain spaces or
     *                                                       special characters. Tags are case insensitive. For readability, consider using
     *                                                       camelCasing or PascalCasing.
     *                                                       - content_classification_labels   Label[]   No    List of labels that should
     *                                                       be set as the Channel’s CCLs.
     *                                                       - is_branded_content              Boolean   No    Boolean flag indicating if
     *                                                       the channel has branded content.
     *
     * @param AccessTokenInterface            $accessToken
     *
     * @return void
     * @throws \JsonException
     *
     * @TODO: change format of body parameter to be readable
     *
     */
    public function modifyChannelInformation(
        string $broadcasterId,
        ModifyChannelInformationRequest $body,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            method: Request::METHOD_PATCH,
            body: $body,
            accessToken: $accessToken,
        );
    }

    /**
     * Gets a list of users that are editors for the specified broadcaster.
     *
     * Authentication:
     * Requires a user access token that includes the channel:read:editors scope.
     *
     * @param string               $broadcasterId      The ID of the broadcaster that owns the channel. This ID must match the user ID in
     *                                                 the access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchDataResponse<ChannelEditor[]>
     * @throws \JsonException
     */
    public function getChannelEditors(
        string $broadcasterId,
        AccessTokenInterface $accessToken
    ): TwitchDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/editors',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: sprintf('%s<%s[]>', TwitchDataResponse::class, ChannelEditor::class),
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of broadcasters that the specified user follows. You can also use this endpoint to see whether a user follows a specific
     * broadcaster.
     *
     * Authorization
     * Requires a user access token that includes the user:read:follows scope.
     *
     * @param string               $userId        A user’s ID. Returns the list of broadcasters that this user follows. This ID must match
     *                                            the user ID in the user OAuth token.
     * @param string|null          $broadcasterId A broadcaster’s ID. Use this parameter to see whether the user follows this broadcaster.
     *                                            If specified, the response contains this broadcaster if the user follows them. If not
     *                                            specified, the response contains all broadcasters that the user follows.
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchPaginatedDataResponse<FollowedChannel[]>
     * @throws \JsonException
     */
    public function getFollowedChannels(
        string $userId,
        AccessTokenInterface $accessToken,
        ?string $broadcasterId = null,
        int $first = 20,
        ?string $after = null
    ): TwitchPaginatedDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/followed',
            query: [
                'user_id' => $userId,
                'broadcaster_id' => $broadcasterId,
                'first' => $first,
                'after' => $after,
            ],
            type: sprintf('%s<%s[]>', TwitchPaginatedDataResponse::class, FollowedChannel::class),
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of users that follow the specified broadcaster. You can also use this endpoint to see whether a specific user follows
     * the broadcaster.
     *
     * Authorization
     * Requires a user access token that includes the moderator:read:followers scope. The ID in the broadcaster_id query parameter must
     * match the user ID in the access token or the user must be a moderator for the specified broadcaster. If a scope is not provided,
     * only the total follower count will be included in the response.
     *
     * @param string               $broadcasterId The broadcaster’s ID. Returns the list of users that follow this broadcaster.
     * @param string|null          $userId        A user’s ID. Use this parameter to see whether the user follows this broadcaster. If
     *                                            specified, the response contains this user if they follow the broadcaster. If not
     *                                            specified, the response contains all users that follow the broadcaster.
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchPaginatedDataResponse<ChannelFollow[]>
     * @throws \JsonException
     *
     * @see https://dev.twitch.tv/docs/api/guide#pagination
     */
    public function getChannelFollowers(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        ?string $userId = null,
        int $first = 20,
        ?string $after = null
    ): TwitchPaginatedDataResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/followers',
            query: [
                'user_id' => $userId,
                'broadcaster_id' => $broadcasterId,
                'first' => $first,
                'after' => $after,
            ],
            type: sprintf('%s<%s[]>', TwitchPaginatedDataResponse::class, ChannelFollow::class),
            accessToken: $accessToken
        );
    }
}
