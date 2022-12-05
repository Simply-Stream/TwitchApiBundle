<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;

class TeamsApi extends AbstractApi
{
    protected const BASE_PATH = 'teams';

    /**
     * Gets the list of Twitch teams that the broadcaster is a member of.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string                    $broadcasterId The ID of the broadcaster whose teams you want to get.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChannelTeams(string $broadcasterId, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/channel',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Gets information about the specified Twitch team.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string               $name The name of the team to get. This parameter and the id parameter are mutually exclusive; you must
     *                                   specify the team’s name or ID but not both.
     * @param string               $id   The ID of the team to get. This parameter and the name parameter are mutually exclusive; you must
     *                                   specify the team’s name or ID but not both.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getTeams(string $name, string $id, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'name' => $name,
                'id' => $id,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }
}
