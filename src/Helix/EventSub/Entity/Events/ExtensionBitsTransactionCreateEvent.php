<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Events;

use SimplyStream\TwitchApiBundle\Helix\EventSub\Entity\Product;

class ExtensionBitsTransactionCreateEvent extends AbstractEvent
{
    use HasUser,
        HasBroadcasterUser;

    /**
     * @var string
     */
    protected $extensionClientId;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @return string
     */
    public function getExtensionClientId(): string
    {
        return $this->extensionClientId;
    }

    /**
     * @param string $extensionClientId
     *
     * @return $this
     */
    public function setExtensionClientId(string $extensionClientId): self
    {
        $this->extensionClientId = $extensionClientId;

        return $this;
    }

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
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     *
     * @return $this
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}