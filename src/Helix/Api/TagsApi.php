<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class TagsApi extends AbstractApi
{
    protected const BASE_PATH = 'tags';

    /**
     * Gets a list of all stream tags that Twitch defines. The broadcaster may apply any of these to their channel except automatic tags.
     *
     * For an online list of the possible tags, see List of All Tags.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string|null               $tagId The ID of the tag to get. Used to filter the list of tags. To specify more than one tag,
     *                                         include the tag_id parameter for each tag to get. For example, tag_id=1234&tag_id=5678. The
     *                                         maximum number of IDs you may specify is 100. Ignores invalid IDs but not duplicate IDs.
     * @param int                       $first The maximum number of items to return per page in the response. The minimum page size is 1
     *                                         item per page and the maximum is 100. The default is 20.
     * @param string|null               $after The cursor used to get the next page of results. The Pagination object in the response
     *                                         contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getAllStreamTags(
        string $tagId = null,
        int $first = 20,
        string $after = null,
        AccessTokenInterface $accessToken = null,
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/streams',
            query: [
                'tag_id' => $tagId,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the list of stream tags that the broadcaster or Twitch added to their channel.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string                    $broadcasterId The ID of the broadcaster whose stream tags you want to get.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getStreamTags(string $broadcasterId, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: 'streams/' . self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Applies one or more tags to the specified channel, overwriting existing tags.
     *
     * NOTE: You may not specify automatic tags; the call fails if you specify automatic tags. Automatic tags are tags that Twitch applies
     * to the channel. For a list of automatic tags, see List of All Tags. To get the list of possible tags programmatically, see Get All
     * Stream Tags.
     *
     * Authentication:
     * Requires a user access token that includes the channel:manage:broadcast scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the channel to apply the tags to. This ID must match
     *                                            the user ID in the access token.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function replaceStreamTags(string $broadcasterId, array $body, AccessTokenInterface $accessToken): void
    {
        $this->sendRequest(
            path: 'streams/' . self::BASE_PATH,
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            method: Request::METHOD_PUT,
            body: $body,
            accessToken: $accessToken
        );
    }
}
