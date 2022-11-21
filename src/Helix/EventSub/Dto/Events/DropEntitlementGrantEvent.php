<?php

namespace SimplyStream\TwitchApiBundle\Helix\EventSub\Dto\Events;

class DropEntitlementGrantEvent extends AbstractEvent
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var array For whatever reason, Twitch documents this specifically as array
     *
     * Content of data:
     *  organization_id    string    The ID of the organization that owns the game that has Drops enabled.
     *  category_id    string    Twitch category ID of the game that was being played when this benefit was entitled.
     *  category_name    string    The category name.
     *  campaign_id    string    The campaign this entitlement is associated with.
     *  user_id    string    Twitch user ID of the user who was granted the entitlement.
     *  user_name    string    The user display name of the user who was granted the entitlement.
     *  user_login    string    The user login of the user who was granted the entitlement.
     *  entitlement_id    string    Unique identifier of the entitlement. Use this to de-duplicate entitlements.
     *  benefit_id    string    Identifier of the Benefit.
     *  created_at    string    UTC timestamp in ISO format when this entitlement was granted on Twitch.
     */
    protected $data;

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
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }
}
