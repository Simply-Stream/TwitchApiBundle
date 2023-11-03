<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Charity;

final readonly class CharityCampaignDonation
{
    /**
     * @param string        $id         An ID that identifies the donation. The ID is unique across campaigns.
     * @param string        $campaignId An ID that identifies the charity campaign that the donation applies to.
     * @param string        $userId     An ID that identifies a user that donated money to the campaign.
     * @param string        $userLogin  The user’s login name.
     * @param string        $userName   The user’s display name.
     * @param CharityAmount $amount     An object that contains the amount of money that the user donated.
     */
    public function __construct(
        private string $id,
        private string $campaignId,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private CharityAmount $amount
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getCampaignId(): string {
        return $this->campaignId;
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

    public function getAmount(): CharityAmount {
        return $this->amount;
    }
}
