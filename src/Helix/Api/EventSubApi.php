<?php

namespace SimplyStream\TwitchApiBundle\Helix\Api;

use League\OAuth2\Client\Token\AccessTokenInterface;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\CreateEventSubSubscriptionRequest;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\EventSubResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\PaginatedEventSubResponse;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Subscription;
use Symfony\Component\HttpFoundation\Request;

class EventSubApi extends AbstractApi
{
    protected const BASE_PATH = 'eventsub';

    /**
     * Creates an EventSub subscription.
     *
     * Authorization:
     * If you use webhooks to receive events, the request must specify an app access token. The request will fail if you use a user access
     * token. If the subscription type requires user authorization, the user must have granted your app (client ID) permissions to receive
     * those events before you subscribe to them. For example, to subscribe to channel.subscribe events, your app must get a user access
     * token that includes the channel:read:subscriptions scope, which adds the required permission to your app access token’s client ID.
     *
     * If you use WebSockets to receive events, the request must specify a user access token. The request will fail if you use an app
     * access token. If the subscription type requires user authorization, the token must include the required scope. However, if the
     * subscription type doesn’t include user authorization, the token may include any scopes or no scopes.
     *
     * @param CreateEventSubSubscriptionRequest $body
     * @param AccessTokenInterface|null         $accessToken
     *
     * @return EventSubResponse<Subscription[]>
     * @throws \JsonException
     */
    public function createEventSubSubscription(
        CreateEventSubSubscriptionRequest $body,
        AccessTokenInterface $accessToken = null
    ): EventSubResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/subscriptions',
            type: sprintf('%s<%s[]>', EventSubResponse::class, Subscription::class),
            method: Request::METHOD_POST,
            body: $body,
            accessToken: $accessToken
        );
    }

    /**
     * Deletes an EventSub subscription.
     *
     * Authorization
     * If you use webhooks to receive events, the request must specify an app access token. The request will fail if you use a user access
     * token.
     *
     * If you use WebSockets to receive events, the request must specify a user access token. The request will fail if you use an app
     * access token. The token may include any scopes.
     *
     * @param string                    $id
     * @param AccessTokenInterface|null $accessToken
     *
     * @return void
     * @throws \JsonException
     */
    public function deleteEventSubSubscription(
        string $id,
        AccessTokenInterface $accessToken = null
    ): void {
        $this->sendRequest(
            path: self::BASE_PATH . '/subscriptions',
            query: [
                'id' => $id,
            ],
            method: Request::METHOD_DELETE,
            accessToken: $accessToken
        );
    }

    /**
     * Gets a list of EventSub subscriptions that the client in the access token created.
     *
     * Authorization
     * If you use webhooks to receive events, the request must specify an app access token. The request will fail if you use a user access
     * token.
     *
     * If you use WebSockets to receive events, the request must specify a user access token. The request will fail if you use an app
     * access token. The token may include any scopes.
     *
     * @param string|null               $status Filter subscriptions by its status. Possible values are:
     *                                          - enabled — The subscription is enabled.
     *                                          - webhook_callback_verification_pending — The subscription is pending verification of the
     *                                          specified callback URL.
     *                                          - webhook_callback_verification_failed — The specified callback URL failed verification.
     *                                          - notification_failures_exceeded — The notification delivery failure rate was too high.
     *                                          - authorization_revoked — The authorization was revoked for one or more users specified in
     *                                          the Condition object.
     *                                          - user_removed — One of the users specified in the Condition object was removed.
     *                                          - version_removed — The subscribed to subscription type and version is no longer supported.
     * @param string|null               $type   Filter subscriptions by subscription type. For a list of subscription types, see
     *                                          Subscription Types.
     * @param string|null               $userId Filter subscriptions by user ID. The response contains subscriptions where this ID matches
     *                                          a user ID that you specified in the Condition object when you created the subscription.
     * @param string|null               $after  The cursor used to get the next page of results. The pagination object in the response
     *                                          contains the cursor’s value.
     * @param AccessTokenInterface|null $accessToken
     *
     * @return PaginatedEventSubResponse<Subscription[]>
     * @throws \JsonException
     */
    public function getEventSubSubscriptions(
        string $status = null,
        string $type = null,
        string $userId = null,
        string $after = null,
        AccessTokenInterface $accessToken = null
    ): PaginatedEventSubResponse {
        return $this->sendRequest(
            path: self::BASE_PATH . '/subscriptions',
            query: [
                'status' => $status,
                'type' => $type,
                'user_id' => $userId,
                'after' => $after,
            ],
            type: sprintf('%s<%s[]>', PaginatedEventSubResponse::class, Subscription::class),
            accessToken: $accessToken
        );
    }
}
