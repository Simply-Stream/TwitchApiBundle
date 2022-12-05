<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class PredictionsApi extends AbstractApi
{
    protected const BASE_PATH = 'predictions';

    /**
     * Gets a list of Channel Points Predictions that the broadcaster created.
     *
     * Authorization:
     * Requires a user access token that includes the channel:read:predictions scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose predictions you want to get. This ID must match the user
     *                                            ID associated with the user access token.
     * @param AccessTokenInterface $accessToken
     * @param string|null          $id            The ID of the prediction to get. To specify more than one ID, include this parameter for
     *                                            each prediction you want to get. For example, id=1234&id=5678. You may specify a maximum
     *                                            of 25 IDs. The endpoint ignores duplicate IDs and those not owned by the broadcaster.
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 25 items per page. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getPredictions(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        string $id = null,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
                'id' => $id,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Creates a Channel Points Prediction.
     *
     * With a Channel Points Prediction, the broadcaster poses a question and viewers try to predict the outcome. The prediction runs as
     * soon as it’s created. The broadcaster may run only one prediction at a time.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:predictions scope.
     *
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function createPrediction(array $body, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH,
            type: 'array',
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Locks, resolves, or cancels a Channel Points Prediction.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:predictions scope.
     *
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function endPrediction(array $body, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH,
            type: 'array',
            method: Request::METHOD_PATCH,
            body: $body,
            accessToken: $accessToken
        );
    }
}
