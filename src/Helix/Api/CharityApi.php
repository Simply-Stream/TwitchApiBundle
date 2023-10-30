<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\CharityCampaign;
use SimplyStream\TwitchApiBundle\Helix\Dto\CharityCampaignDonation;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;

class CharityApi extends AbstractApi
{
    protected const BASE_PATH = 'charity/campaigns';

    /**
     * (BETA) Gets information about the charity campaign that a broadcaster is running. For example, the campaign’s fundraising goal and
     * the current amount of donations.
     *
     * To receive events when progress is made towards the campaign’s goal or the broadcaster changes the fundraising goal, subscribe to
     * the channel.charity_campaign.progress subscription type.
     *
     * Authorization:
     * Requires a user access token that includes the channel:read:charity scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that’s currently running a charity campaign. This ID must match
     *                                            the user ID in the access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getCharityCampaign(
        string $broadcasterId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: CharityCampaign::class . '[]',
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Gets the list of donations that users have made to the broadcaster’s active charity campaign.
     *
     * To receive events as donations occur, subscribe to the channel.charity_campaign.donate subscription type.
     *
     * Authorization:
     * Requires a user access token that includes the channel:read:charity scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that’s currently running a charity campaign. This ID must match
     *                                            the user ID in the access token.
     * @param AccessTokenInterface $accessToken
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getCharityCampaignDonations(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'first' => $first,
                'after' => $after,
            ],
            type: CharityCampaignDonation::class . '[]',
            accessToken: $accessToken
        );
    }
}
