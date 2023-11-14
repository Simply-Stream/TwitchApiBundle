<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

use SimplyStream\TwitchApiBundle\Helix\Models\Charity\CharityAmount;

final readonly class CharityDonationEvent extends Event
{
    /**
     * @param string        $id                 An ID that identifies the donation. The ID is unique across campaigns.
     * @param string        $campaignId         An ID that identifies the charity campaign.
     * @param string        $broadcasterId      An ID that identifies the broadcaster that’s running the campaign.
     * @param string        $broadcasterLogin   The broadcaster’s login name.
     * @param string        $broadcasterName    The broadcaster’s display name.
     * @param string        $userId             An ID that identifies the user that donated to the campaign.
     * @param string        $userLogin          The user’s login name.
     * @param string        $userName           The user’s display name.
     * @param string        $charityName        The charity’s name.
     * @param string        $charityDescription A description of the charity.
     * @param string        $charityLogo        A URL to an image of the charity’s logo. The image’s type is PNG and its size is 100px X
     *                                          100px.
     * @param string        $charityWebsite     A URL to the charity’s website.
     * @param CharityAmount $amount             An object that contains the amount of money that the user donated.
     */
    public function __construct(
        private string $id,
        private string $campaignId,
        private string $broadcasterId,
        private string $broadcasterLogin,
        private string $broadcasterName,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $charityName,
        private string $charityDescription,
        private string $charityLogo,
        private string $charityWebsite,
        private CharityAmount $amount
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getCampaignId(): string {
        return $this->campaignId;
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getUserLogin(): string {
        return $this->userLogin;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getCharityName(): string {
        return $this->charityName;
    }

    public function getCharityDescription(): string {
        return $this->charityDescription;
    }

    public function getCharityLogo(): string {
        return $this->charityLogo;
    }

    public function getCharityWebsite(): string {
        return $this->charityWebsite;
    }

    public function getAmount(): CharityAmount {
        return $this->amount;
    }
}
