<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

use JMS\Serializer\Annotation as Serializer;

class StreamSchedule
{
    /**
     * The list of broadcasts in the broadcaster’s streaming schedule.
     *
     * @var array<StreamScheduleSegment>
     * @Serializer\Type("array<SimplyStream\TwitchApiBundle\Helix\Dto\StreamScheduleSegment>")
     */
    protected array $segments;

    /**
     * The ID of the broadcaster that owns the broadcast schedule.
     *
     * @var string
     */
    protected string $broadcaster_id;

    /**
     * The broadcaster’s display name.
     *
     * @var string
     */
    protected string $broadcaster_name;

    /**
     * The broadcaster’s login name.
     *
     * @var string
     */
    protected string $broadcaster_login;

    /**
     * The dates when the broadcaster is on vacation and not streaming. Is set to null if vacation mode is not enabled.
     *
     * @var array|null
     * @Serializer\Type("array")
     */
    protected ?array $vacation;

    /**
     * @return array
     */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * @param array $segments
     *
     * @return StreamSchedule
     */
    public function setSegments(array $segments): StreamSchedule
    {
        $this->segments = $segments;

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
     * @return StreamSchedule
     */
    public function setBroadcasterId(string $broadcaster_id): StreamSchedule
    {
        $this->broadcaster_id = $broadcaster_id;

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
     * @return StreamSchedule
     */
    public function setBroadcasterName(string $broadcaster_name): StreamSchedule
    {
        $this->broadcaster_name = $broadcaster_name;

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
     * @return StreamSchedule
     */
    public function setBroadcasterLogin(string $broadcaster_login): StreamSchedule
    {
        $this->broadcaster_login = $broadcaster_login;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getVacation(): ?array
    {
        return $this->vacation;
    }

    /**
     * @param array|null $vacation
     *
     * @return StreamSchedule
     */
    public function setVacation(?array $vacation): StreamSchedule
    {
        $this->vacation = $vacation;

        return $this;
    }
}
