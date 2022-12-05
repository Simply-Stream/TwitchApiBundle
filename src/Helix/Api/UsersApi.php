<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use JsonException;
use League\OAuth2\Client\Token\AccessTokenInterface;
use RuntimeException;
use SimplyStream\TwitchApiBundle\Helix\Dto\Follows;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponse;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchUser;
use Symfony\Component\HttpFoundation\Request;

class UsersApi extends AbstractApi
{
    const BASE_PATH = 'users';

    /**
     * Gets information about one or more users.
     *
     * You may look up users using their user ID, login name, or both but the sum total of the number of users you may look up is 100. For
     * example, you may specify 50 IDs and 50 names or 100 IDs or names, but you cannot specify 100 IDs and 100 names.
     *
     * If you don’t specify IDs or login names, the request returns information about the user in the access token if you specify a user
     * access token.
     *
     * To include the user’s verified email address in the response, you must use a user access token that includes the user:read:email
     * scope.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param array                     $ids    The ID of the user to get. To specify more than one user, include the id parameter for each
     *                                          user to get. For example, id=1234&id=5678. The maximum number of IDs you may specify is
     *                                          100.
     * @param array                     $logins The login name of the user to get. To specify more than one user, include the login
     *                                          parameter for each user to get. For example, login=foo&login=bar. The maximum number of
     *                                          login names you may specify is 100.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponse
     * @throws JsonException
     */
    public function getUsers(array $ids = [], array $logins = [], AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        if (count($ids) === 0 && count($logins) === 0) {
            throw new RuntimeException('You need to specify at least one "id" or "login"');
        }

        if (count($ids) + count($logins)) {
            throw new RuntimeException('You can only request a total amount of 100 users at once');
        }

        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'id' => $ids,
                'login' => $logins,
            ],
            type: 'array<' . TwitchUser::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Updates the specified user’s information. The user ID in the OAuth token identifies the user whose information you want to update.
     *
     * To include the user’s verified email address in the response, the user access token must also include the user:read:email scope.
     *
     * Authentication:
     * Requires a user access token that includes the user:edit scope.
     *
     * @param AccessTokenInterface $accessToken
     * @param string|null          $description The string to update the channel’s description to. The description is limited to a maximum
     *                                          of 300 characters.
     *
     *                                          To remove the description, specify this parameter but don’t set it’s value (for example,
     *                                          ?description=).
     *
     * @return TwitchResponseInterface
     * @throws JsonException
     */
    public function updateUser(AccessTokenInterface $accessToken, string $description = null): TwitchResponseInterface
    {
        if (strlen($description) > 300) {
            throw new RuntimeException('A description can not be longer than 300 characters');
        }

        return $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'description' => $description,
            ],
            type: 'array<' . TwitchUser::class . '>',
            method: Request::METHOD_PUT,
            accessToken: $accessToken
        );
    }

    /**
     * Gets information about users that are following other users. For example, you can use this endpoint to answer questions like “who is
     * qotrok following,” “who is following qotrok,” or “is user X following user Y.”
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string|null               $fromId A user ID. Specify this parameter to discover the users that this user is following.
     *
     *                                          You must specify this parameter, the to_id parameter, or both.
     * @param string|null               $toId   A user ID. Specify this parameter to discover the users who are following this user.
     *
     *                                          You must specify this parameter, the from_id parameter, or both.
     * @param int                       $first  The maximum number of items to return per page in the response. The minimum page size is 1
     *                                          item per page and the maximum is 100. The default is 20.
     * @param string|null               $after  The cursor used to get the next page of results. The Pagination object in the response
     *                                          contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws JsonException
     */
    public function getUsersFollows(
        string $fromId = null,
        string $toId = null,
        int $first = 20,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        if (! $fromId && ! $toId) {
            throw new RuntimeException('At minimum, fromId or toId must be provided for a query to be valid.');
        }

        return $this->sendRequest(
            path: self::BASE_PATH . '/follows',
            query: [
                'to_id' => $toId,
                'from_id' => $fromId,
                'after' => $after,
                'first' => $first,
            ],
            type: 'array<' . Follows::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the list of users that the broadcaster has blocked. Read More
     *
     * Authentication:
     * Requires a user access token that includes the user:read:blocked_users scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose list of blocked users you want to get.
     * @param AccessTokenInterface $accessToken
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws JsonException
     */
    public function getUserBlockList(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/blocks',
            query: [
                'broadcaster_id' => $broadcasterId,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Blocks the specified user from interacting with or having contact with the broadcaster. The user ID in the OAuth token identifies
     * the broadcaster who is blocking the user.
     *
     * To learn more about blocking users, see Block Other Users on Twitch.
     *
     * Authentication:
     * Requires a user access token that includes the user:manage:blocked_users scope.
     *
     * @param string               $targetUserId  The ID of the user to block. The API ignores the request if the broadcaster has already
     *                                            blocked the user.
     * @param AccessTokenInterface $accessToken
     * @param string|null          $sourceContext The location where the harassment took place that is causing the brodcaster to block the
     *                                            user. Possible values are:
     *                                            - chat
     *                                            - whisper
     * @param string|null          $reason        The reason that the broadcaster is blocking the user. Possible values are:
     *                                            - harassment
     *                                            - spam
     *                                            - other
     *
     * @return void
     * @throws JsonException
     */
    public function blockUser(
        string $targetUserId,
        AccessTokenInterface $accessToken,
        string $sourceContext = null,
        string $reason = null
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/blocks',
            query: [
                'target_user_id' => $targetUserId,
                'source_context' => $sourceContext,
                'reason' => $reason,
            ],
            method: Request::METHOD_PUT,
            accessToken: $accessToken
        );
    }

    /**
     * Removes the user from the broadcaster’s list of blocked users. The user ID in the OAuth token identifies the broadcaster who’s
     * removing the block.
     *
     * Authentication:
     * Requires a user access token that includes the user:manage:blocked_users scope.
     *
     * @param string               $targetUserId The ID of the user to remove from the broadcaster’s list of blocked users. The API ignores
     *                                           the request if the broadcaster hasn’t blocked the user.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws JsonException
     */
    public function unblockUser(string $targetUserId, AccessTokenInterface $accessToken): void
    {
        $this->sendRequest(
            path: self::BASE_PATH . '/blocks',
            query: [
                'target_user_id' => $targetUserId,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of all extensions (both active and inactive) that the broadcaster has installed. The user ID in the access token
     * identifies the broadcaster.
     *
     * Authentication:
     * Requires a user access token that includes the user:read:broadcast or user:edit:broadcast scope. To include inactive extensions, you
     * must include the user:edit:broadcast scope.
     *
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws JsonException
     */
    public function getUserExtensions(AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/extensions/list',
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the active extensions that the broadcaster has installed for each configuration.
     *
     * NOTE: To include extensions that you have under development, you must specify a user access token that includes the
     * user:read:broadcast or user:edit:broadcast scope.
     *
     * Authentication:
     * Requires an app access token or user access token.
     *
     * @param string|null               $userId The ID of the broadcaster whose active extensions you want to get.
     *
     *                                          This parameter is required if you specify an app access token and is optional if you
     *                                          specify a user access token. If you specify a user access token and don’t specify this
     *                                          parameter, the API uses the user ID from the access token.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws JsonException
     */
    public function getUserActiveExtensions(string $userId = null, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/extensions',
            query: [
                'user_id' => $userId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Updates an installed extension’s information. You can update the extension’s activation state, ID, and version number. The user ID
     * in the access token identifies the broadcaster whose extensions you’re updating.
     *
     * NOTE: If you try to activate an extension under multiple extension types, the last write wins (and there is no guarantee of write
     * order).
     *
     * Authentication:
     * Requires a user access token that includes the user:edit:broadcast scope.
     *
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws JsonException
     */
    public function updateUserExtensions(array $body, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/extensions',
            method: Request::METHOD_PUT,
            body: $body,
            accessToken: $accessToken
        );
    }
}
