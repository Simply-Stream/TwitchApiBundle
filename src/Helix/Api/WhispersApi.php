<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use Symfony\Component\HttpFoundation\Request;

class WhispersApi extends AbstractApi
{
    protected const BASE_PATH = 'whispers';

    /**
     * Sends a whisper message to the specified user.
     *
     * NOTE: The user sending the whisper must have a verified phone number (see the Phone Number setting in your Security and Privacy
     * settings).
     *
     * NOTE: The API may silently drop whispers that it suspects of violating Twitch policies. (The API does not indicate that it dropped
     * the whisper; it returns a 204 status code as if it succeeded.)
     *
     * Rate Limits: You may whisper to a maximum of 40 unique recipients per day. Within the per day limit, you may whisper a maximum of 3
     * whispers per second and a maximum of 100 whispers per minute.
     *
     * Authorization:
     * Requires a user access token that includes the user:manage:whispers scope.
     *
     * @param string               $fromUserId The ID of the user sending the whisper. This user must have a verified phone number. This ID
     *                                         must match the user ID in the user access token.
     * @param string               $toUserId   The ID of the user to receive the whisper.
     * @param array                $body
     * @param AccessTokenInterface $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function sendWhisper(
        string $fromUserId,
        string $toUserId,
        array $body,
        AccessTokenInterface $accessToken
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH,
            query: [
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
            ],
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }
}
