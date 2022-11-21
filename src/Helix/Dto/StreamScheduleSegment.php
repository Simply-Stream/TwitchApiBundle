<?php

namespace SimplyStream\TwitchApiBundle\Helix\Dto;

use JMS\Serializer\Annotation as Serializer;

class StreamScheduleSegment
{
    /**
     * An ID that identifies this broadcast segment.
     *
     * @var string
     */
    protected string $id;

    /**
     * The UTC date and time (in RFC3339 format) of when the broadcast starts.
     *
     * @var \DateTimeImmutable
     */
    protected \DateTimeImmutable $start_time;

    /**
     * The UTC date and time (in RFC3339 format) of when the broadcast ends.
     *
     * @var \DateTimeImmutable
     */
    protected \DateTimeImmutable $end_time;

    /**
     * The broadcast segment’s title.
     *
     * @var string
     */
    protected string $title;

    /**
     * Indicates whether the broadcaster canceled this segment of a recurring broadcast. If the broadcaster canceled this segment, this
     * field is set to the same value that’s in the end_time field; otherwise, it’s set to null.
     *
     * @var string|null
     */
    protected ?string $canceled_until = null;

    /**
     * The type of content that the broadcaster plans to stream or null if not specified.
     *
     * @var array|null
     * @Serializer\Type("SimplyStream\TwitchApiBundle\Helix\Dto\Game")
     */
    protected ?array $category = null;

    /**
     * A Boolean value that determines whether the broadcast is part of a recurring series that streams at the same time each week or is a
     * one-time broadcast. Is true if the broadcast is part of a recurring series.
     *
     * @var bool
     */
    protected bool $is_recurring = false;

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
     * @return StreamScheduleSegment
     */
    public function setId(string $id): StreamScheduleSegment
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStartTime(): \DateTimeImmutable
    {
        return $this->start_time;
    }

    /**
     * @param \DateTimeImmutable $start_time
     *
     * @return StreamScheduleSegment
     */
    public function setStartTime(\DateTimeImmutable $start_time): StreamScheduleSegment
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getEndTime(): \DateTimeImmutable
    {
        return $this->end_time;
    }

    /**
     * @param \DateTimeImmutable $end_time
     *
     * @return StreamScheduleSegment
     */
    public function setEndTime(\DateTimeImmutable $end_time): StreamScheduleSegment
    {
        $this->end_time = $end_time;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return StreamScheduleSegment
     */
    public function setTitle(string $title): StreamScheduleSegment
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCanceledUntil(): ?string
    {
        return $this->canceled_until;
    }

    /**
     * @param string|null $canceled_until
     *
     * @return StreamScheduleSegment
     */
    public function setCanceledUntil(?string $canceled_until): StreamScheduleSegment
    {
        $this->canceled_until = $canceled_until;

        return $this;
    }

    /**
     * @return array|null
     */
    public function getCategory(): ?array
    {
        return $this->category;
    }

    /**
     * @param array|null $category
     *
     * @return StreamScheduleSegment
     */
    public function setCategory(?array $category): StreamScheduleSegment
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return bool
     */
    public function isIsRecurring(): bool
    {
        return $this->is_recurring;
    }

    /**
     * @param bool $is_recurring
     *
     * @return StreamScheduleSegment
     */
    public function setIsRecurring(bool $is_recurring): StreamScheduleSegment
    {
        $this->is_recurring = $is_recurring;

        return $this;
    }
}
