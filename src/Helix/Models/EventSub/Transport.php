<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;
use Webmozart\Assert\Assert;

final readonly class Transport
{
    use SerializesModels;

    /**
     * @param string      $method    The transport method. Possible values are:
     *                               - webhook
     *                               - websocket
     * @param string|null $callback  The callback URL where the notifications are sent. The URL must use the HTTPS protocol and port 443.
     *                               See Processing an event.
     *
     *                               Specify this field only if method is set to webhook.
     *
     *                               NOTE: Redirects are not followed.
     * @param string|null $secret    The secret used to verify the signature. The secret must be an ASCII string that’s a minimum of 10
     *                               characters long and a maximum of 100 characters long. For information about how the secret is used,
     *                               see Verifying the event message.
     *
     *                               Specify this field only if method is set to webhook.
     * @param string|null $sessionId An ID that identifies the WebSocket to send notifications to. When you connect to EventSub using
     *                               WebSockets, the server returns the ID in the Welcome message.
     *
     *                               Specify this field only if method is set to websocket.
     */
    public function __construct(
        private string $method,
        private ?string $callback = null,
        private ?string $secret = null,
        private ?string $sessionId = null
    ) {
        Assert::inArray($this->method, ['webhook', 'websocket']);
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getCallback(): ?string {
        return $this->callback;
    }

    public function getSecret(): ?string {
        return $this->secret;
    }

    public function getSessionId(): ?string {
        return $this->sessionId;
    }
}
