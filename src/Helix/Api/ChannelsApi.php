<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\ChannelEditor;
use SimplyStream\TwitchApiBundle\Helix\Dto\ChannelInformation;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponse;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
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
     * @return TwitchResponse
     * @throws \JsonException
     */
    public function getChannelInformation(array $broadcasterId, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: ['broadcaster_id' => $broadcasterId],
            type: 'array<' . ChannelInformation::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Updates a channel’s properties.
     *
     * Authentication:
     * Requires a user access token that includes the channel:manage:broadcast scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose channel you want to update. This ID must match the
     *                                            user ID associated with the user access token.
     * @param array                $body
     *                                            - game_id    String    No    The ID of the game that the user plays. The game is not
     *                                            updated if the ID isn’t a game ID that Twitch recognizes. To unset this field, use
     *                                            “0” or “” (an empty string).
     *                                            - broadcaster_language    String    No    The user’s
     *                                            preferred language. Set the value to an ISO 639-1 two-letter language code (for
     *                                            example, en for English). Set to “other” if the user’s preferred language is not a
     *                                            Twitch supported language. The language isn’t updated if the language code isn’t a
     *                                            Twitch supported language.
     *                                            - title    String    No    The title of the user’s stream. You may not set this
     *                                            field to an empty string.
     *                                            - delay    Integer    No    The number
     *                                            of seconds you want your broadcast buffered before streaming it live. The delay
     *                                            helps ensure fairness during competitive play. Only users with Partner status may
     *                                            set this field. The maximum delay is 900 seconds (15 minutes).
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function modifyChannelInformation(
        string $broadcasterId,
        array $body,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
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
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChannelEditors(string $broadcasterId, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/editors',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array<' . ChannelEditor::class . '>',
            accessToken: $accessToken
        );
    }
}
