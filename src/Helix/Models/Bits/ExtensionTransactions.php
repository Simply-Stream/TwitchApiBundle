<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Bits;

final readonly class ExtensionTransactions
{
    /**
     * @param string             $id               An ID that identifies the transaction.
     * @param \DateTimeImmutable $timestamp        The UTC date and time (in RFC3339 format) of the transaction.
     * @param string             $broadcasterId    The ID of the broadcaster that owns the channel where the transaction occurred.
     * @param string             $broadcasterLogin The broadcaster’s login name.
     * @param string             $broadcasterName  The broadcaster’s display name.
     * @param string             $userId           The ID of the user that purchased the digital product.
     * @param string             $userLogin        The user’s login name.
     * @param string             $userName         The user’s display name.
     * @param string             $productType      The type of transaction. Possible values are:
     *                                             - BITS_IN_EXTENSION
     * @param ProductData        $productData      Contains details about the digital product.
     */
    public function __construct(
        private string $id,
        private \DateTimeImmutable $timestamp,
        private string $broadcasterId,
        private string $broadcasterLogin,
        private string $broadcasterName,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private string $productType,
        private ProductData $productData
    ) {
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTimestamp(): \DateTimeImmutable {
        return $this->timestamp;
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

    public function getProductType(): string {
        return $this->productType;
    }

    public function getProductData(): ProductData {
        return $this->productData;
    }
}
