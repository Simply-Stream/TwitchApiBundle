<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class GiftPaidUpgrade
{
    use SerializesModels;

    /**
     * @param bool        $gifterIsAnonymous Whether the gift was given anonymously.
     * @param string|null $gifterUserId      Optional. The user ID of the user who gifted the subscription. Null if anonymous.
     * @param string|null $gifterUserName    Optional. The user name of the user who gifted the subscription. Null if anonymous.
     * @param string|null $gifterUserLogin   Optional. The user login of the user who gifted the subscription. Null if anonymous.
     */
    public function __construct(
        private bool $gifterIsAnonymous,
        private ?string $gifterUserId = null,
        private ?string $gifterUserName = null,
        private ?string $gifterUserLogin = null
    ) {
    }

    public function isGifterIsAnonymous(): bool {
        return $this->gifterIsAnonymous;
    }

    public function getGifterUserId(): string {
        return $this->gifterUserId;
    }

    public function getGifterUserName(): string {
        return $this->gifterUserName;
    }

    public function getGifterUserLogin(): string {
        return $this->gifterUserLogin;
    }
}
