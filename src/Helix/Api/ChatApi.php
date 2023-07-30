<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\ChatBadge;
use SimplyStream\TwitchApiBundle\Helix\Dto\ChatBadgeSet;
use SimplyStream\TwitchApiBundle\Helix\Dto\ChatColor;
use SimplyStream\TwitchApiBundle\Helix\Dto\ChatSettings;
use SimplyStream\TwitchApiBundle\Helix\Dto\Chatter;
use SimplyStream\TwitchApiBundle\Helix\Dto\Emote;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class ChatApi extends AbstractApi
{
    protected const BASE_PATH = 'chat';

    /**
     * Gets the list of users that are connected to the broadcaster’s chat session.
     *
     * NOTE: There is a delay between when users join and leave a chat and when the list is updated accordingly.
     *
     * To determine whether a user is a moderator or VIP, use the Get Moderators and Get VIPs endpoints. You can check the roles of up to
     * 100 users.
     *
     * Authorization:
     * Requires a user access token that includes the moderator:read:chatters scope.
     *
     * @param string               $broadcasterId The ID of the broadcaster whose list of chatters you want to get.
     * @param string               $moderatorId   The ID of the broadcaster or one of the broadcaster’s moderators. This ID must match the
     *                                            user ID in the user access token.
     * @param AccessTokenInterface $accessToken
     * @param int                  $first         The maximum number of items to return per page in the response. The minimum page size is
     *                                            1 item per page and the maximum is 1,000. The default is 100.
     * @param string|null          $after         The cursor used to get the next page of results. The Pagination object in the response
     *                                            contains the cursor’s value.
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChatter(
        string $broadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken,
        int $first = 100,
        string $after = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/chatters',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'first' => $first,
                'after' => $after,
            ],
            type: 'array<' . Chatter::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets all emotes that the specified Twitch channel created. Broadcasters create these custom emotes for users who subscribe to or
     * follow the channel or cheer Bits in the channel’s chat window. Learn More
     *
     * For information about the custom emotes, see subscriber emotes, Bits tier emotes, and follower emotes.
     *
     * NOTE: With the exception of custom follower emotes, users may use custom emotes in any Twitch chat.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $broadcasterId An ID that identifies the broadcaster whose emotes you want to get.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChannelEmotes(string $broadcasterId, ?AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/emotes',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array<' . Emote::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the list of global emotes. Global emotes are Twitch-created emotes that users can use in any Twitch chat.
     *
     * Authorization
     * Requires an app access token or user access token.
     *
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getGlobalEmotes(?AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/emotes/global',
            type: 'array<' . Emote::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets emotes for one or more specified emote sets.
     *
     * An emote set groups emotes that have a similar context. For example, Twitch places all the subscriber emotes that a broadcaster
     * uploads for their channel in the same emote set.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $emoteSetId An ID that identifies the emote set to get. Include this parameter for each emote set
     *                                              you want to get. For example, emote_set_id=1234&emote_set_id=5678. You may specify a
     *                                              maximum of 25 IDs. The response contains only the IDs that were found and ignores
     *                                              duplicate IDs.
     *
     *                                              To get emote set IDs, use the Get Channel Emotes API.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getEmoteSets(string $emoteSetId, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/emotes/set',
            query: [
                'emote_set_id' => $emoteSetId,
            ],
            type: 'array<' . Emote::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets all badges that the specified broadcaster created. The list is empty if the broadcaster hasn’t created custom chat badges. For
     * information about custom badges, see subscriber badges and Bits badges.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $broadcasterId The ID of the broadcaster whose chat badges you want to get.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChannelChatBadges(string $broadcasterId, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/badges',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array<' . ChatBadgeSet::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the list of chat badges that Twitch created. Users can use these badges in any channel’s chat room. For information about chat
     * badges, see Twitch Chat Badges Guide.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getGlobalChatBadges(AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/badges/global',
            type: 'array<' . ChatBadgeSet::class . '<' . ChatBadge::class . '>>',
            accessToken: $accessToken
        );
    }

    /**
     * Gets the broadcaster’s chat settings.
     *
     * For an overview of chat settings, see Chat Commands for Broadcasters and Moderators and Moderator Preferences.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $broadcasterId The ID of the broadcaster whose chat settings you want to get.
     * @param string|null               $moderatorId   The ID of a user that has permission to moderate the broadcaster’s chat room, or the
     *                                                 broadcaster’s ID if they’re getting the settings.
     *
     *                                                 This field is required only if you want to include the non_moderator_chat_delay and
     *                                                 non_moderator_chat_delay_duration settings in the response.
     *
     *                                                 If you specify this field, this ID must match the user ID in the user access token.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChatSettings(
        string $broadcasterId,
        string $moderatorId = null,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array<' . ChatSettings::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Updates the broadcaster’s chat settings.
     *
     * Authentication:
     * Requires a user access token that includes the moderator:manage:chat_settings scope.
     *
     * @param string                    $broadcasterId The ID of the broadcaster whose chat settings you want to update.
     * @param string                    $moderatorId   The ID of a user that has permission to moderate the broadcaster’s chat room, or the
     *                                                 broadcaster’s ID if they’re making the update. This ID must match the user ID in the
     *                                                 user access token.
     * @param array                     $body
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function updateChatSettings(
        string $broadcasterId,
        string $moderatorId,
        array $body,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array<' . ChatSettings::class . '>',
            method: Request::METHOD_PATCH,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Sends an announcement to the broadcaster’s chat room.
     *
     * Authorization:
     * Requires a user access token that includes the moderator:manage:announcements scope.
     *
     * @param string                    $broadcasterId The ID of the broadcaster that owns the chat room to send the announcement to.
     * @param string                    $moderatorId   The ID of a user who has permission to moderate the broadcaster’s chat room, or the
     *                                                 broadcaster’s ID if they’re sending the announcement. This ID must match the user ID
     *                                                 in the user access token.
     * @param array                     $body
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function sendChatAnnouncement(
        string $broadcasterId,
        string $moderatorId,
        array $body,
        AccessTokenInterface $accessToken = null
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/announcements',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Sends a Shoutout to the specified broadcaster. Typically, you send Shoutouts when you or one of your moderators notice another
     * broadcaster in your chat, the other broadcaster is coming up in conversation, or after they raid your broadcast.
     *
     * Twitch’s Shoutout feature is a great way for you to show support for other broadcasters and help them grow. Viewers who do not
     * follow the other broadcaster will see a pop-up Follow button in your chat that they can click to follow the other broadcaster. Learn
     * More
     *
     * Rate Limits The broadcaster may send a Shoutout once every 2 minutes. They may send the same broadcaster a Shoutout once every 60
     * minutes.
     *
     * To receive notifications when a Shoutout is sent or received, subscribe to the channel.shoutout.create and channel.shoutout.receive
     * subscription types. The channel.shoutout.create event includes cooldown periods that indicate when the broadcaster may send another
     * Shoutout without exceeding the endpoint’s rate limit.
     *
     * Authorization
     * Requires a user access token that includes the moderator:manage:shoutouts scope.
     *
     * @param string               $fromBroadcasterId The ID of the broadcaster that’s sending the Shoutout.
     * @param string               $toBroadcasterId   The ID of the broadcaster that’s receiving the Shoutout.
     * @param string               $moderatorId       The ID of the broadcaster or a user that is one of the broadcaster’s moderators. This
     *                                                ID must match the user ID in the access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function sendShoutout(
        string $fromBroadcasterId,
        string $toBroadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/shoutouts',
            query: [
                'from_broadcaster_id' => $fromBroadcasterId,
                'to_broadcaster_id' => $toBroadcasterId,
                'moderator_id' => $moderatorId,
            ],
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * Gets the color used for the user’s name in chat.
     *
     * Authorization:
     * Requires an app access token or user access token.
     *
     * @param string                    $userId The ID of the user whose username color you want to get. To specify more than one user,
     *                                          include the user_id parameter for each user to get. For example,
     *                                          &user_id=1234&user_id=5678. The maximum number of IDs that you may specify is 100.
     *
     *                                          The API ignores duplicate IDs and IDs that weren’t found.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getUserChatColor(string $userId, AccessTokenInterface $accessToken = null): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/color',
            query: [
                'user_id' => $userId,
            ],
            type: 'array<' . ChatColor::class . '>',
            accessToken: $accessToken
        );
    }

    /**
     * Updates the color used for the user’s name in chat.
     *
     * Authorization:
     * Requires a user access token that includes the user:manage:chat_color scope.
     *
     * @param string               $userId The ID of the user whose chat color you want to update. This ID must match the user ID in the
     *                                     access token.
     * @param string               $color  The color to use for the user’s name in chat. All users may specify one of the following named
     *                                     color values.
     *                                     - blue
     *                                     - blue_violet
     *                                     - cadet_blue
     *                                     - chocolate
     *                                     - coral
     *                                     - dodger_blue
     *                                     - firebrick
     *                                     - golden_rod
     *                                     - green
     *                                     - hot_pink
     *                                     - orange_red
     *                                     - red
     *                                     - sea_green
     *                                     - spring_green
     *                                     - yellow_green
     *
     *                                     Turbo and Prime users may specify a named color or a Hex color code like #9146FF. If you use a
     *                                     Hex color code, remember to URL encode it.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function updateUserChatColor(string $userId, string $color, AccessTokenInterface $accessToken): TwitchResponseInterface
    {
        return $this->sendRequest(
            path: self::BASE_PATH . '/color',
            query: [
                'user_id' => $userId,
                'color' => $color,
            ],
            method: Request::METHOD_PUT,
            accessToken: $accessToken
        );
    }
}
