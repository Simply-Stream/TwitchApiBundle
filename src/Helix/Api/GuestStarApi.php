<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Dto\TwitchResponseInterface;
use Symfony\Component\HttpFoundation\Request;

class GuestStarApi extends AbstractApi
{
    protected const BASE_PATH = 'guest_star';

    /**
     * (BETA) Gets the channel settings for configuration of the Guest Star feature for a particular host.
     *
     * Authorization
     * - Query parameter moderator_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:read:guest_star, channel:manage:guest_star, moderator:read:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId      The ID of the broadcaster you want to get guest star settings for.
     * @param string               $moderatorId        The ID of the broadcaster or a user that has permission to moderate the
     *                                                 broadcaster’s chat room. This ID must match the user ID in the user access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getChannelGuestStarSettings(
        string $broadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/channel_settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Mutates the channel settings for configuration of the Guest Star feature for a particular host.
     *
     * Authorization
     * - Query parameter broadcaster_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star
     *
     * @param string               $broadcasterId The ID of the broadcaster you want to update Guest Star settings for.
     * @param AccessTokenInterface $accessToken
     * @param array                $body
     *
     * @return void
     * @throws \JsonException
     */
    public function updateChannelGuestStarSettings(
        string $broadcasterId,
        AccessTokenInterface $accessToken,
        array $body = []
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/channel_settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                ...$body
            ],
            method: Request::METHOD_PUT,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Gets information about an ongoing Guest Star session for a particular channel.
     *
     * Authorization
     * - Requires OAuth Scope: channel:read:guest_star, channel:manage:guest_star, moderator:read:guest_star or moderator:manage:guest_star
     * - Guests must be either invited or assigned a slot within the session
     *
     * @param string               $broadcasterId      ID for the user hosting the Guest Star session.
     * @param string               $moderatorId        The ID of the broadcaster or a user that has permission to moderate the
     *                                                 broadcaster’s chat room. This ID must match the user ID in the user access token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getGuestStarSession(
        string $broadcasterId,
        string $moderatorId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/session',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Programmatically creates a Guest Star session on behalf of the broadcaster. Requires the broadcaster to be present in the
     * call interface, or the call will be ended automatically.
     *
     * Authorization
     * - Query parameter broadcaster_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star
     *
     * @param string               $broadcasterId The ID of the broadcaster you want to create a Guest Star session for. Provided
     *                                            broadcaster_id must match the user_id in the auth token.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function createGuestStarSession(
        string $broadcasterId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/session',
            query: [
                'broadcaster_id' => $broadcasterId,
            ],
            type: 'array',
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Programmatically ends a Guest Star session on behalf of the broadcaster. Performs the same action as if the host clicked the
     * “End Call” button in the Guest Star UI.
     *
     * Authorization
     * - Query parameter broadcaster_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star
     *
     * @param string               $broadcasterId The ID of the broadcaster you want to end a Guest Star session for. Provided
     *                                            broadcaster_id must match the user_id in the auth token.
     * @param string               $sessionId     ID for the session to end on behalf of the broadcaster.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function endGuestStarSession(
        string $broadcasterId,
        string $sessionId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/session',
            query: [
                'broadcaster_id' => $broadcasterId,
                'session_id' => $sessionId,
            ],
            type: 'array',
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Provides the caller with a list of pending invites to a Guest Star session, including the invitee’s ready status while
     * joining the waiting room.
     *
     * Authorization
     * - Query parameter broadcaster_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:read:guest_star, channel:manage:guest_star, moderator:read:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId The ID of the broadcaster running the Guest Star session.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user_id in the user access token.
     * @param string               $sessionId     The session ID to query for invite status.
     * @param AccessTokenInterface $accessToken
     *
     * @return TwitchResponseInterface
     * @throws \JsonException
     */
    public function getGuestStarInvites(
        string $broadcasterId,
        string $moderatorId,
        string $sessionId,
        AccessTokenInterface $accessToken
    ): TwitchResponseInterface {
        return $this->sendRequest(
            path: self::BASE_PATH . '/invites',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'session_id' => $sessionId
            ],
            type: 'array',
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Sends an invite to a specified guest on behalf of the broadcaster for a Guest Star session in progress.
     *
     * Authorization
     * - Query parameter moderator_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId The ID of the broadcaster running the Guest Star session.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user_id in the user access token.
     * @param string               $sessionId     The session ID for the invite to be sent on behalf of the broadcaster.
     * @param string               $guestId       Twitch User ID for the guest to invite to the Guest Star session.
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function sendGuestStarInvite(
        string $broadcasterId,
        string $moderatorId,
        string $sessionId,
        string $guestId,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/invites',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'session_id' => $sessionId,
                'guest_id' => $guestId
            ],
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Revokes a previously sent invite for a Guest Star session.
     *
     * Authorization
     * - Query parameter moderator_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId The ID of the broadcaster running the Guest Star session.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user_id in the user access token.
     *
     * @param string               $sessionId     The ID of the session for the invite to be revoked on behalf of the broadcaster.
     * @param string               $guestId       Twitch User ID for the guest to revoke the Guest Star session invite from.
     *
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function deleteGuestStarInvite(
        string $broadcasterId,
        string $moderatorId,
        string $sessionId,
        string $guestId,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/invites',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'session_id' => $sessionId,
                'guest_id' => $guestId
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Allows a previously invited user to be assigned a slot within the active Guest Star session, once that guest has indicated
     * they are ready to join.
     *
     * Authorization
     * - Query parameter moderator_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId The ID of the broadcaster running the Guest Star session.
     * @param string               $moderatorId   The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                            chat room. This ID must match the user_id in the user access token.
     * @param string               $sessionId     The ID of the Guest Star session in which to assign the slot.
     * @param string               $guestId       The Twitch User ID corresponding to the guest to assign a slot in the session. This user
     *                                            must already have an invite to this session, and have indicated that they are ready to
     *                                            join.
     * @param string               $slotId        The slot assignment to give to the user. Must be a numeric identifier between “1” and “N”
     *                                            where N is the max number of slots for the session. Max number of slots allowed for the
     *                                            session is reported by Get Channel Guest Star Settings
     *                                            (https://dev.twitch.tv/docs/api/reference/#get-channel-guest-star-settings).
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function assignGuestStarSlot(
        string $broadcasterId,
        string $moderatorId,
        string $sessionId,
        string $guestId,
        string $slotId,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/slot',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'session_id' => $sessionId,
                'guest_id' => $guestId,
                'slot_id' => $slotId
            ],
            method: Request::METHOD_POST,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Allows a user to update the assigned slot for a particular user within the active Guest Star session.
     *
     * Authorization
     * - Query parameter moderator_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId     The ID of the broadcaster running the Guest Star session.
     * @param string               $moderatorId       The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                                chat room. This ID must match the user_id in the user access token.
     * @param string               $sessionId         The ID of the Guest Star session in which to update slot settings.
     * @param string               $sourceSlotId      The slot assignment previously assigned to a user.
     * @param AccessTokenInterface $accessToken
     *
     * @param string|null          $destinationSlotId The slot to move this user assignment to. If the destination slot is occupied, the
     *                                                user assigned will be swapped into source_slot_id.
     *
     * @return void
     * @throws \JsonException
     */
    public function updateGuestStarSlot(
        string $broadcasterId,
        string $moderatorId,
        string $sessionId,
        string $sourceSlotId,
        AccessTokenInterface $accessToken,
        string $destinationSlotId = null
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/slot',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'session_id' => $sessionId,
                'source_slot_id' => $sourceSlotId,
                'destination_slot_id' => $destinationSlotId
            ],
            type: 'array',
            method: Request::METHOD_PATCH,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Allows a caller to remove a slot assignment from a user participating in an active Guest Star session. This revokes their
     * access to the session immediately and disables their access to publish or subscribe to media within the session.
     *
     * Authorization
     * - Query parameter moderator_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId       The ID of the broadcaster running the Guest Star session.
     * @param string               $moderatorId         The ID of the broadcaster or a user that has permission to moderate the
     *                                                  broadcaster’s chat room. This ID must match the user ID in the user access token.
     * @param string               $sessionId           The ID of the Guest Star session in which to remove the slot assignment.
     * @param string               $guestId             The Twitch User ID corresponding to the guest to remove from the session.
     * @param string               $slotId              The slot ID representing the slot assignment to remove from the session.
     * @param AccessTokenInterface $accessToken
     * @param string|null          $shouldReinviteGuest Flag signaling that the guest should be reinvited to the session, sending them back
     *                                                  to the invite queue.
     *
     * @return void
     * @throws \JsonException
     */
    public function deleteGuestStarSlot(
        string $broadcasterId,
        string $moderatorId,
        string $sessionId,
        string $guestId,
        string $slotId,
        AccessTokenInterface $accessToken,
        string $shouldReinviteGuest = null
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/slot',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'session_id' => $sessionId,
                'guest_id' => $guestId,
                'slot_id' => $slotId,
                'should_reinvite_guest' => $shouldReinviteGuest
            ],
            type: 'array',
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * (BETA) Allows a user to update slot settings for a particular guest within a Guest Star session, such as allowing the user to share
     * audio or video within the call as a host. These settings will be broadcasted to all subscribers which control their view of the
     * guest in that slot. One or more of the optional parameters to this API can be specified at any time.
     *
     * Authorization
     * - Query parameter moderator_id must match the user_id in the User-Access token
     * - Requires OAuth Scope: channel:manage:guest_star or moderator:manage:guest_star
     *
     * @param string               $broadcasterId  The ID of the broadcaster running the Guest Star session.
     * @param string               $moderatorId    The ID of the broadcaster or a user that has permission to moderate the broadcaster’s
     *                                             chat room. This ID must match the user ID in the user access token.
     * @param string               $sessionId      The ID of the Guest Star session in which to update a slot’s settings.
     * @param string               $slotId         The slot assignment that has previously been assigned to a user.
     * @param AccessTokenInterface $accessToken
     * @param bool|null            $isAudioEnabled Flag indicating whether the slot is allowed to share their audio with the rest of the
     *                                             session. If false, the slot will be muted in any views containing the slot.
     * @param bool|null            $isVideoEnabled Flag indicating whether the slot is allowed to share their video with the rest of the
     *                                             session. If false, the slot will have no video shared in any views containing the slot.
     * @param bool|null            $isLive         Flag indicating whether the user assigned to this slot is visible/can be heard from any
     *                                             public subscriptions. Generally, this determines whether or not the slot is enabled in
     *                                             any broadcasting software integrations.
     * @param int|null             $volume         Value from 0-100 that controls the audio volume for shared views containing the slot.
     *
     * @return void
     * @throws \JsonException
     */
    public function updateGuestStarSlotSettings(
        string $broadcasterId,
        string $moderatorId,
        string $sessionId,
        string $slotId,
        AccessTokenInterface $accessToken,
        bool $isAudioEnabled = null,
        bool $isVideoEnabled = null,
        bool $isLive = null,
        int $volume = null
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/slot_settings',
            query: [
                'broadcaster_id' => $broadcasterId,
                'moderator_id' => $moderatorId,
                'session_id' => $sessionId,
                'slot_id' => $slotId,
                'is_audio_enabled' => $isAudioEnabled,
                'is_video_enabled' => $isVideoEnabled,
                'is_live' => $isLive,
                'volume' => $volume
            ],
            method: Request::METHOD_PATCH,
            accessToken: $accessToken
        );
    }
}
