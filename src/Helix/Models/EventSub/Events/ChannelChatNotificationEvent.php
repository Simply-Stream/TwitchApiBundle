<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications\Badge;
use SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events\Notifications\Message;

final readonly class ChannelChatNotificationEvent extends Event
{
    /**
     * @param string                                       $broadcasterUserId    The broadcaster user ID.
     * @param string                                       $broadcasterUserName  The broadcaster display name.
     * @param string                                       $broadcasterUserLogin The broadcaster login.
     * @param string                                       $chatterUserId        The user ID of the user that sent the message.
     * @param string                                       $chatterUserName      The user name of the user that sent the message.
     * @param string                                       $chatterUserLogin     The user login of the user that sent the message.
     * @param bool                                         $chatterIsAnonymous   Whether or not the chatter is anonymous.
     * @param string                                       $color                The color of the user’s name in the chat room.
     * @param Badge[]                                      $badges               List of chat badges.
     * @param string                                       $systemMessage        The message Twitch shows in the chat room for this notice.
     * @param string                                       $messageId            A UUID that identifies the message.
     * @param Message                                      $message              The structured chat message
     * @param string                                       $noticeType           The type of notice. Possible values are:
     *                                                                           - sub
     *                                                                           - resub
     *                                                                           - sub_gift
     *                                                                           - community_sub_gift
     *                                                                           - gift_paid_upgrade
     *                                                                           - prime_paid_upgrade
     *                                                                           - raid
     *                                                                           - unraid
     *                                                                           - pay_it_forward
     *                                                                           - announcement
     *                                                                           - bits_badge_tier
     *                                                                           - charity_donation
     * @param Notifications\Subscription|null              $sub                  Information about the sub event. Null if notice_type is
     *                                                                           not sub.
     * @param Notifications\Resubscription|null            $resub                Information about the resub event. Null if notice_type is
     *                                                                           not resub.
     * @param Notifications\GiftSubscription|null          $subGift              Information about the gift sub event. Null if notice_type
     *                                                                           is not sub_gift.
     * @param Notifications\CommunityGiftSubscription|null $communitySubGift     Information about the community gift sub event. Null if
     *                                                                           notice_type is not community_sub_gift.
     * @param Notifications\GiftPaidUpgrade|null           $giftPaidUpgrade      Information about the community gift paid upgrade event.
     *                                                                           Null if notice_type is not gift_paid_upgrade.
     * @param Notifications\PrimePaidUpgrade|null          $primePaidUpgrade     Information about the Prime gift paid upgrade event. Null
     *                                                                           if notice_type is not prime_paid_upgrade.
     * @param Notifications\Raid|null                      $raid                 Information about the raid event. Null if notice_type is
     *                                                                           not raid.
     * @param array|null                                   $unraid               Returns an empty payload if notice_type is unraid,
     *                                                                           otherwise returns null.
     * @param Notifications\PayItForward|null              $payItForward         Information about the pay it forward event. Null if
     *                                                                           notice_type is not pay_it_forward.
     * @param Notifications\Announcement|null              $announcement         Information about the announcement event. Null if
     *                                                                           notice_type is not announcement
     * @param Notifications\CharityDonation|null           $charityDonation      Information about the charity donation event. Null if
     *                                                                           notice_type is not charity_donation.
     * @param Notifications\BitsBadgeTier|null             $bitsBadgeTier        Information about the bits badge tier event. Null if
     *                                                                           notice_type is not bits_badge_tier.
     */
    public function __construct(
        private string $broadcasterUserId,
        private string $broadcasterUserName,
        private string $broadcasterUserLogin,
        private string $chatterUserId,
        private string $chatterUserName,
        private string $chatterUserLogin,
        private bool $chatterIsAnonymous,
        private string $color,
        private array $badges,
        private string $systemMessage,
        private string $messageId,
        private Message $message,
        private string $noticeType,
        private ?Notifications\Subscription $sub = null,
        private ?Notifications\Resubscription $resub = null,
        private ?Notifications\GiftSubscription $subGift = null,
        private ?Notifications\CommunityGiftSubscription $communitySubGift = null,
        private ?Notifications\GiftPaidUpgrade $giftPaidUpgrade = null,
        private ?Notifications\PrimePaidUpgrade $primePaidUpgrade = null,
        private ?Notifications\Raid $raid = null,
        private ?array $unraid = null,
        private ?Notifications\PayItForward $payItForward = null,
        private ?Notifications\Announcement $announcement = null,
        private ?Notifications\CharityDonation $charityDonation = null,
        private ?Notifications\BitsBadgeTier $bitsBadgeTier = null,
    ) {
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getChatterUserId(): string {
        return $this->chatterUserId;
    }

    public function getChatterUserName(): string {
        return $this->chatterUserName;
    }

    public function getChatterUserLogin(): string {
        return $this->chatterUserLogin;
    }

    public function isChatterIsAnonymous(): bool {
        return $this->chatterIsAnonymous;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function getBadges(): array {
        return $this->badges;
    }

    public function getSystemMessage(): string {
        return $this->systemMessage;
    }

    public function getMessageId(): string {
        return $this->messageId;
    }

    public function getMessage(): Message {
        return $this->message;
    }

    public function getNoticeType(): string {
        return $this->noticeType;
    }

    public function getSub(): ?Notifications\Subscription {
        return $this->sub;
    }

    public function getResub(): ?Notifications\Resubscription {
        return $this->resub;
    }

    public function getSubGift(): ?Notifications\GiftSubscription {
        return $this->subGift;
    }

    public function getCommunitySubGift(): ?Notifications\CommunityGiftSubscription {
        return $this->communitySubGift;
    }

    public function getGiftPaidUpgrade(): ?Notifications\GiftPaidUpgrade {
        return $this->giftPaidUpgrade;
    }

    public function getPrimePaidUpgrade(): ?Notifications\PrimePaidUpgrade {
        return $this->primePaidUpgrade;
    }

    public function getRaid(): ?Notifications\Raid {
        return $this->raid;
    }

    public function getUnraid(): ?array {
        return $this->unraid;
    }

    public function getPayItForward(): ?Notifications\PayItForward {
        return $this->payItForward;
    }

    public function getAnnouncement(): ?Notifications\Announcement {
        return $this->announcement;
    }

    public function getCharityDonation(): ?Notifications\CharityDonation {
        return $this->charityDonation;
    }

    public function getBitsBadgeTier(): ?Notifications\BitsBadgeTier {
        return $this->bitsBadgeTier;
    }
}
