<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications;

use SimplyStream\TwitchApiBundle\Helix\Models\SerializesModels;

final readonly class GiftSubscription
{
    use SerializesModels;

    /**
     * @param int         $durationMonths     The number of months the subscription is for.
     * @param string      $recipientUserId    The user ID of the subscription gift recipient.
     * @param string      $recipientUserName  The user name of the subscription gift recipient.
     * @param string      $recipientUserLogin The user login of the subscription gift recipient.
     * @param string      $subTier            The type of subscription plan being used. Possible values are:
     *                                        - 1000 — First level of paid subscription
     *                                        - 2000 — Second level of paid subscription
     *                                        - 3000 — Third level of paid subscription
     * @param int|null    $cumulativeTotal    Optional. The amount of gifts the gifter has given in this channel. Null if anonymous.
     * @param string|null $communityGiftId    Optional. The ID of the associated community gift. Null if not associated with a community
     *                                        gift.
     */
    public function __construct(
        private int $durationMonths,
        private string $recipientUserId,
        private string $recipientUserName,
        private string $recipientUserLogin,
        private string $subTier,
        private ?int $cumulativeTotal = null,
        private ?string $communityGiftId = null
    ) {
    }

    public function getDurationMonths(): int {
        return $this->durationMonths;
    }

    public function getRecipientUserId(): string {
        return $this->recipientUserId;
    }

    public function getRecipientUserName(): string {
        return $this->recipientUserName;
    }

    public function getRecipientUserLogin(): string {
        return $this->recipientUserLogin;
    }

    public function getSubTier(): string {
        return $this->subTier;
    }

    public function getCumulativeTotal(): ?int {
        return $this->cumulativeTotal;
    }

    public function getCommunityGiftId(): ?string {
        return $this->communityGiftId;
    }
}
