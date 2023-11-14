<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\EventSub\Events;

final readonly class ExtensionBitsTransactionCreateEvent extends Event
{
    /**
     * @param string  $extensionClientId    Client ID of the extension.
     * @param string  $id                   Transaction ID.
     * @param string  $broadcasterUserId    The transaction’s broadcaster ID.
     * @param string  $broadcasterUserLogin The transaction’s broadcaster login.
     * @param string  $broadcasterUserName  The transaction’s broadcaster display name.
     * @param string  $userId               The transaction’s user ID.
     * @param string  $userLogin            The transaction’s user login.
     * @param string  $userName             The transaction’s user display name.
     * @param Product $product              Additional extension product information.
     */
    public function __construct(
        private string $extensionClientId,
        private string $id,
        private string $broadcasterUserId,
        private string $broadcasterUserLogin,
        private string $broadcasterUserName,
        private string $userId,
        private string $userLogin,
        private string $userName,
        private Product $product
    ) {
    }

    public function getExtensionClientId(): string {
        return $this->extensionClientId;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getBroadcasterUserId(): string {
        return $this->broadcasterUserId;
    }

    public function getBroadcasterUserLogin(): string {
        return $this->broadcasterUserLogin;
    }

    public function getBroadcasterUserName(): string {
        return $this->broadcasterUserName;
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

    public function getProduct(): Product {
        return $this->product;
    }
}
