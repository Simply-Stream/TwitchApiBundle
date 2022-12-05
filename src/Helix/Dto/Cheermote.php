<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

class Cheermote
{

    /**
     * The name portion of the Cheermote string that you use in chat to cheer Bits. The full Cheermote string is the
     * concatenation of {prefix} + {number of Bits}. For example, if the prefix is “Cheer” and you want to cheer 100 Bits, the full
     * Cheermote string is Cheer100. When the Cheermote string is entered in chat, Twitch converts it to the image associated with the Bits
     * tier that was cheered.
     *
     * @var string
     */
    protected string $prefix;

    /**
     * A list of tier levels that the Cheermote supports. Each tier identifies the range of Bits that you
     * can cheer at
     * that tier level and an image that graphically identifies the tier level.
     *
     * @var array
     */
    protected array $tiers;
    /**
     * The type of Cheermote. Possible values are:
     * - global_first_party — A Twitch-defined Cheermote that is shown in the Bits card.
     * - global_third_party — A Twitch-defined Cheermote that is not shown in the Bits card.
     * - channel_custom — A broadcaster-defined Cheermote.
     * - display_only — Do not use; for internal use only.
     * - sponsored — A sponsor-defined Cheermote. When used, the sponsor adds additional Bits to the amount that the user cheered. For
     *               example, if the user cheered Terminator100, the broadcaster might receive 110 Bits, which includes the sponsor's 10
     *               Bits contribution.
     *
     * @var string
     */
    protected string $type;

    /**
     * The order that the Cheermotes are shown in the Bits card. The numbers may not be consecutive. for
     * example, the numbers may jump from 1 to 7 to 13. The order numbers are unique within a Cheermote type (for example,
     * global_first_party) but may not be unique amongst all Cheermotes in the response.
     *
     * @var int
     */
    protected int $order;

    /**
     * The date and time, in RFC3339 format, when this Cheermote was last updated.
     *
     * @var string
     */
    protected string $last_updated;

    /**
     * A Boolean value that indicates whether this Cheermote provides a charitable contribution match during charity campaigns.
     *
     * @var string
     */
    protected string $is_charitable;

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     *
     * @return Cheermote
     */
    public function setPrefix(string $prefix): Cheermote
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return array
     */
    public function getTiers(): array
    {
        return $this->tiers;
    }

    /**
     * @param array $tiers
     *
     * @return Cheermote
     */
    public function setTiers(array $tiers): Cheermote
    {
        $this->tiers = $tiers;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Cheermote
     */
    public function setType(string $type): Cheermote
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     *
     * @return Cheermote
     */
    public function setOrder(int $order): Cheermote
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastUpdated(): string
    {
        return $this->last_updated;
    }

    /**
     * @param string $last_updated
     *
     * @return Cheermote
     */
    public function setLastUpdated(string $last_updated): Cheermote
    {
        $this->last_updated = $last_updated;

        return $this;
    }

    /**
     * @return string
     */
    public function getIsCharitable(): string
    {
        return $this->is_charitable;
    }

    /**
     * @param string $is_charitable
     *
     * @return Cheermote
     */
    public function setIsCharitable(string $is_charitable): Cheermote
    {
        $this->is_charitable = $is_charitable;

        return $this;
    }
}
