<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class ExtensionTransaction
{
    /**
     * An ID that identifies the transaction.
     *
     * @var string
     */
    protected string $id;

    /**
     * The UTC date and time (in RFC3339 format) of the transaction.
     *
     * @var string
     */
    protected \DateTime $timestamp;

    /**
     * The ID of the broadcaster that owns the channel where the transaction occurred.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * The broadcaster’s login name.
     *
     * @var string
     */
    protected string $broadcaster_login;
    /**
     * The broadcaster’s display name.
     *
     * @var string
     */
    protected string $broadcaster_name;

    /**
     * The ID of the user that purchased the digital product.
     *
     * @var string
     */
    protected string $user_id;

    /**
     * The user’s login name.
     *
     * @var string
     */
    protected string $user_login;

    /**
     * The user’s display name.
     *
     * @var string
     */
    protected string $user_name;

    /**
     * The type of transaction. Possible values are:
     * - BITS_IN_EXTENSION
     *
     * @var string
     */
    protected string $product_type;

    /**
     * Contains details about the digital product.
     *
     * @var array
     */
    protected array $product_data;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return ExtensionTransaction
     */
    public function setId(string $id): ExtensionTransaction
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param \DateTime $timestamp
     *
     * @return ExtensionTransaction
     */
    public function setTimestamp(\DateTime $timestamp): ExtensionTransaction
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterId(): string
    {
        return $this->broadcaster_id;
    }

    /**
     * @param string $broadcaster_id
     *
     * @return ExtensionTransaction
     */
    public function setBroadcasterId(string $broadcaster_id): ExtensionTransaction
    {
        $this->broadcaster_id = $broadcaster_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterLogin(): string
    {
        return $this->broadcaster_login;
    }

    /**
     * @param string $broadcaster_login
     *
     * @return ExtensionTransaction
     */
    public function setBroadcasterLogin(string $broadcaster_login): ExtensionTransaction
    {
        $this->broadcaster_login = $broadcaster_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getBroadcasterName(): string
    {
        return $this->broadcaster_name;
    }

    /**
     * @param string $broadcaster_name
     *
     * @return ExtensionTransaction
     */
    public function setBroadcasterName(string $broadcaster_name): ExtensionTransaction
    {
        $this->broadcaster_name = $broadcaster_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $user_id
     *
     * @return ExtensionTransaction
     */
    public function setUserId(string $user_id): ExtensionTransaction
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserLogin(): string
    {
        return $this->user_login;
    }

    /**
     * @param string $user_login
     *
     * @return ExtensionTransaction
     */
    public function setUserLogin(string $user_login): ExtensionTransaction
    {
        $this->user_login = $user_login;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @param string $user_name
     *
     * @return ExtensionTransaction
     */
    public function setUserName(string $user_name): ExtensionTransaction
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductType(): string
    {
        return $this->product_type;
    }

    /**
     * @param string $product_type
     *
     * @return ExtensionTransaction
     */
    public function setProductType(string $product_type): ExtensionTransaction
    {
        $this->product_type = $product_type;

        return $this;
    }

    /**
     * @return array
     */
    public function getProductData(): array
    {
        return $this->product_data;
    }

    /**
     * @param array $product_data
     *
     * @return ExtensionTransaction
     */
    public function setProductData(array $product_data): ExtensionTransaction
    {
        $this->product_data = $product_data;

        return $this;
    }
}
