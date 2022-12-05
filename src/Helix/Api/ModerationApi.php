<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class ModerationApi extends AbstractApi
{
    protected const BASE_PATH = 'moderation';

    /**
     * Checks whether AutoMod would flag the specified message for review.
     *
     * AutoMod is a moderation tool that holds inappropriate or harassing chat messages for moderators to review. Moderators approve or
     * deny the messages that AutoMod flags; only approved messages are released to chat. AutoMod detects misspellings and evasive language
     * automatically. For information about AutoMod, see How to Use AutoMod.
     *
     * Rate Limits: Rates are limited per channel based on the account type rather than per access token.
     *
     * Account type | Limit per minute | Limit per hour
     * -------------|------------------|---------------
     * Normal       | 5                | 50
     * -------------|------------------|---------------
     * Affiliate    | 10               | 100
     * -------------|------------------|---------------
     * Partner      | 30               | 300
     * ------------------------------------------------
     * The above limits are in addition to the standard Twitch API rate limits. The rate limit headers in the response represent the Twitch
     * rate limits and not the above limits.
     *
     * Authorization:
     * Requires a user access token that includes the moderation:read scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose AutoMod settings and list of blocked terms are used to
     *                                            check the message. This ID must match the user ID in the access token.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function checkAutoModStatus(string $broadcasterId, array $body, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/enforcements/status',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array',
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Allow or deny the message that AutoMod flagged for review. For information about AutoMod, see How to Use AutoMod.
     *
     * To get messages that AutoMod is holding for review, subscribe to the automod-queue.<moderator_id>.<channel_id> topic using PubSub.
     * PubSub sends a notification to your app when AutoMod holds a message for review.
     *
     * Authorization:
     * Requires a user access token that includes the moderator:manage:automod scope.
     *
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function manageHeldAutoModMessages(array $body, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/automod/message',
            type: 'array',
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Gets the broadcaster’s AutoMod settings. The settings are used to automatically block inappropriate or harassing messages from
     * appearing in the broadcaster’s chat room.
     *
     * Authorization:
     * Requires a user access token that includes the moderator:read:automod_settings scope.
     *
     * @param string               $broadcasterId
     * @param string               $moderatorId
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getAutoModSettings(
        string $broadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/automod/settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Updates the broadcaster’s AutoMod settings. The settings are used to automatically block inappropriate or harassing messages from
     * appearing in the broadcaster’s chat room.
     *
     * Authorization:
     * Requires a user access token that includes the moderator:manage:automod_settings scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose AutoMod settings you want to update.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user ID in the user access token.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function updateAutoModSettings(
        string $broadcasterId,
        string $moderatorId,
        array $body,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/automod/settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array',
            method: Request::METHOD_PUT,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Gets all users that the broadcaster banned or put in a timeout.
     *
     * Authentication:
     * Requires a user access token that includes the moderation:read scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose list of banned users you want to get. This ID must match
     *                                            the user ID in the access token.
     * @param AccessTokenInterface $accessToken
     * @param string|null          $userId        A list of user IDs used to filter the results. To specify more than one ID, include this
     *                                            parameter for each user you want to get. For example, user_id=1234&user_id=5678. You may
     *                                            specify a maximum of 100 IDs.
     *
     *                                            The returned list includes only those users that were banned or put in a timeout. The
     *                                            list is returned in the same order that you specified the IDs.
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100 items per page. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     * @param string|null          $before        The cursor used to get the previous page of results. The Pagination object in the
     *                                            response contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getBannedUsers(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        string $userId = null,
        int $first = 20,
        string $after = null,
        string $before = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/banned',
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
                'first' => $first,
                'after' => $after,
                'before' => $before,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Bans a user from participating in the specified broadcaster’s chat room or puts them in a timeout.
     *
     * For information about banning or putting users in a timeout, see Ban a User and Timeout a User.
     *
     * If the user is currently in a timeout, you can call this endpoint to change the duration of the timeout or ban them altogether. If
     * the user is currently banned, you cannot call this method to put them in a timeout instead.
     *
     * To remove a ban or end a timeout, see Unban user.
     *
     * Authentication:
     * Requires a user access token that includes the moderator:manage:banned_users scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose chat room the user is being banned from.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user ID in the user access token.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function banUser(
        string $broadcasterId,
        string $moderatorId,
        array $body,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/bans',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array',
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Removes the ban or timeout that was placed on the specified user.
     *
     * To ban a user, see Ban user.
     *
     * Authentication:
     * Requires a user access token that includes the moderator:manage:banned_users scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose chat room the user is banned from chatting in.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user ID in the user access token.
     * @param string               $userId        The ID of the user to remove the ban or timeout from.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function unbanUser(
        string $broadcasterId,
        string $moderatorId,
        string $userId,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/bans',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'user_id' => $userId,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * Gets the broadcaster’s list of non-private, blocked words or phrases. These are the terms that the broadcaster or moderator added
     * manually or that were denied by AutoMod.
     *
     * Authorization:
     * Requires a user access token that includes the moderator:read:blocked_terms scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose blocked terms you’re getting.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user ID in the user access token.
     * @param AccessTokenInterface $accessToken
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100 items per page. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getBlockedTerms(
        string $broadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/blocked_terms',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Adds a word or phrase to the broadcaster’s list of blocked terms. These are the terms that the broadcaster doesn’t want used in
     * their chat room.
     *
     * Authentication:
     * Requires a user access token that includes the moderator:manage:blocked_terms scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the list of blocked terms.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user ID in the user access token.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function addBlockedTerm(
        string $broadcasterId,
        string $moderatorId,
        array $body,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/blocked_terms',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array',
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Removes the word or phrase from the broadcaster’s list of blocked terms.
     *
     * Authentication:
     * Requires a user access token that includes the moderator:manage:blocked_terms scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the list of blocked terms.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user ID in the user access token.
     * @param string               $id            The ID of the blocked term to remove from the broadcaster’s list of blocked terms.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function removeBlockedTerm(
        string $broadcasterId,
        string $moderatorId,
        string $id,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/blocked_terms',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'id' => $id,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * Removes a single chat message or all chat messages from the broadcaster’s chat room.
     *
     * Authentication:
     * Requires a user access token that includes the moderator:manage:chat_messages scope.
     *
     * @param string               $broadcasterId
     * @param string               $moderatorId
     * @param AccessTokenInterface $accessToken
     * @param string|null          $messageId
     *
     * @return void
     * @throws \JsonException
     */
    public function deleteChatMessages(
        string $broadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken,
        string $messageId = null
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/chat',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'message_id' => $messageId,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * Gets all users allowed to moderate the broadcaster’s chat room.
     *
     * Authorization:
     * Requires a user access token that includes the moderation:read scope. If your app also adds and removes moderators, you can use the
     * channel:manage:moderators scope instead.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose list of moderators you want to get. This ID must match
     *                                            the user ID in the access token.
     * @param AccessTokenInterface $accessToken
     * @param string|null          $userId        A list of user IDs used to filter the results. To specify more than one ID, include this
     *                                            parameter for each moderator you want to get. For example, user_id=1234&user_id=5678. You
     *                                            may specify a maximum of 100 IDs.
     *
     *                                            The returned list includes only the users from the list who are moderators in the
     *                                            broadcaster’s channel. The list is returned in the same order as you specified the IDs.
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100 items per page. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getModerators(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        string $userId = null,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/moderators',
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Adds a moderator to the broadcaster’s chat room.
     *
     * Rate Limits: The broadcaster may add a maximum of 10 moderators within a 10-second window.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:moderators scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the chat room. This ID must match the user ID in the
     *                                            access token.
     * @param string               $userId        The ID of the user to add as a moderator in the broadcaster’s chat room.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function addChannelModerator(string $broadcasterId, string $userId, AccessTokenInterface $accessToken): void
    {
        $this->sendRequest(
            path: self::BASE_PATH . '/moderators',
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
            ],
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * Removes a moderator from the broadcaster’s chat room.
     *
     * Rate Limits: The broadcaster may remove a maximum of 10 moderators within a 10-second window.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:moderators scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster that owns the chat room. This ID must match the user ID in the
     *                                            access token.
     * @param string               $userId        The ID of the user to remove as a moderator from the broadcaster’s chat room.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function removeChannelModerator(string $broadcasterId, string $userId, AccessTokenInterface $accessToken): void
    {
        $this->sendRequest(
            path: self::BASE_PATH . '/moderators',
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of the broadcaster’s VIPs.
     *
     * Authorization:
     * Requires a user access token that includes the channel:read:vips scope. If your app also adds and removes VIP status, you can use
     * the channel:manage:vips scope instead.
     *
     * @TODO: I don't really know why this is a case of moderation, it's even stored under channels namespace.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose list of VIPs you want to get. This ID must match the user
     *                                            ID in the access token.
     * @param AccessTokenInterface $accessToken
     * @param string|null          $userId        Filters the list for specific VIPs. To specify more than one user, include the user_id
     *                                            parameter for each user to get. For example, &user_id=1234&user_id=5678. The maximum
     *                                            number of IDs that you may specify is 100. Ignores the ID of those users in the list that
     *                                            aren’t VIPs.
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 100. The default is 20.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getVips(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        string $userId = null,
        int $first = 20,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: '/channels/vips',
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * Adds the specified user as a VIP in the broadcaster’s channel.
     *
     * Rate Limits: The broadcaster may add a maximum of 10 VIPs within a 10-second window.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:vips scope.
     *
     * @TODO: I don't really know why this is a case of moderation, it's even stored under channels namespace.
     *
     * @param string               $userId        The ID of the user to give VIP status to.
     * @param string               $broadcasterId The ID of the broadcaster that’s adding the user as a VIP. This ID must match the user ID
     *                                            in the access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function addChannelVip(string $userId, string $broadcasterId, AccessTokenInterface $accessToken): void
    {
        $this->sendRequest(
            path: '/channels/vips',
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
            ],
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * Removes the specified user as a VIP in the broadcaster’s channel.
     *
     * If the broadcaster is removing the user’s VIP status, the ID in the broadcaster_id query parameter must match the user ID in the
     * access token; otherwise, if the user is removing their VIP status themselves, the ID in the user_id query parameter must match the
     * user ID in the access token.
     *
     * Rate Limits: The broadcaster may remove a maximum of 10 VIPs within a 10-second window.
     *
     * Authorization:
     * Requires a user access token that includes the channel:manage:vips scope.
     *
     * @TODO: I don't really know why this is a case of moderation, it's even stored under channels namespace.
     *
     * @param string               $userId        The ID of the user to remove VIP status from.
     * @param string               $broadcasterId The ID of the broadcaster who owns the channel where the user has VIP status.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function removeChannelVip(string $userId, string $broadcasterId, AccessTokenInterface $accessToken): void
    {
        $this->sendRequest(
            path: '/channels/vips',
            query: [
                'broadcaster_id' => $broadcasterId,
                'user_id' => $userId,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Activates or deactivates the broadcaster’s Shield Mode.
     *
     * Twitch’s Shield Mode feature is like a panic button that broadcasters can push to protect themselves from chat abuse coming from one
     * or more accounts. When activated, Shield Mode applies the overrides that the broadcaster configured in the Twitch UX. If the
     * broadcaster hasn’t configured Shield Mode, it applies default overrides.
     *
     * Authorization:
     * Requires a user access token that includes the moderator:manage:shield_mode scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose Shield Mode you want to activate or deactivate.
     * @param string               $moderatorId   The ID of the broadcaster or a user that is one of the broadcaster’s moderators. This ID
     *                                            must match the user ID in the access token.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function updateShieldModeStatus(
        string $broadcasterId,
        string $moderatorId,
        array $body,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/shield_mode',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array',
            method: Request::METHOD_PUT,
            body: $body,
        );
    }

    /**
     * (BETA) Gets the broadcaster’s Shield Mode activation status.
     *
     * To receive notification when the broadcaster activates and deactivates Shield Mode, subscribe to the channel.shield_mode.begin and
     * channel.shield_mode.end subscription types.
     *
     * Authorization
     * Requires a user access token that includes the moderator:read:shield_mode or moderator:manage:shield_mode scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose Shield Mode activation status you want to get.
     * @param string               $moderatorId   The ID of the broadcaster or a user that is one of the broadcaster’s moderators. This ID
     *                                            must match the user ID in the access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getShieldModeStatus(
        string $broadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/shield_mode',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }
}
