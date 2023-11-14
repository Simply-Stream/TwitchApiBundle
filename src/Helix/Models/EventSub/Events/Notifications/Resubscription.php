<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class Resubscription
{
    use SerializesModels;

    /**
     * @param int         $cumulativeMonths  The total number of months the user has subscribed.
     * @param int         $durationMonths    The number of months the subscription is for.
     * @param string      $subTier           The type of subscription plan being used. Possible values are:
     *                                       - 1000 — First level of paid or Prime subscription
     *                                       - 2000 — Second level of paid subscription
     *                                       - 3000 — Third level of paid subscription
     * @param bool        $isPrime           Indicates if the resub was obtained through Amazon Prime.
     * @param bool        $isGift            Whether or not the resub was a result of a gift.
     * @param int|null    $streakMonths      Optional. The number of consecutive months the user has subscribed.
     * @param bool|null   $gifterIsAnonymous Optional. Whether or not the gift was anonymous.
     * @param string|null $gifterUserId      Optional. The user ID of the subscription gifter. Null if anonymous.
     * @param string|null $gifterUserName    Optional. The user name of the subscription gifter. Null if anonymous.
     * @param string|null $gifterUserLogin   Optional. The user login of the subscription gifter. Null if anonymous.
     */
    public function __construct(
        private int $cumulativeMonths,
        private int $durationMonths,
        private string $subTier,
        private bool $isPrime,
        private bool $isGift,
        private ?int $streakMonths = null,
        private ?bool $gifterIsAnonymous = null,
        private ?string $gifterUserId = null,
        private ?string $gifterUserName = null,
        private ?string $gifterUserLogin = null
    ) {
    }

    public function getCumulativeMonths(): int {
        return $this->cumulativeMonths;
    }

    public function getDurationMonths(): int {
        return $this->durationMonths;
    }

    public function getSubTier(): string {
        return $this->subTier;
    }

    public function isPrime(): bool {
        return $this->isPrime;
    }

    public function isGift(): bool {
        return $this->isGift;
    }

    public function getStreakMonths(): ?int {
        return $this->streakMonths;
    }

    public function getGifterIsAnonymous(): ?bool {
        return $this->gifterIsAnonymous;
    }

    public function getGifterUserId(): ?string {
        return $this->gifterUserId;
    }

    public function getGifterUserName(): ?string {
        return $this->gifterUserName;
    }

    public function getGifterUserLogin(): ?string {
        return $this->gifterUserLogin;
    }
}
