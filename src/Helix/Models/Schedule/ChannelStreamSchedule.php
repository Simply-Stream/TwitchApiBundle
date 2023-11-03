<?php

namespace SimplyStream\TwitchApiBundle\Helix\Models\Schedule;

final readonly class ChannelStreamSchedule
{
    /**
     * @param ScheduleSegment[] $segments
     * @param string            $broadcasterId
     * @param string            $broadcasterName
     * @param string            $broadcasterLogin
     * @param array             $vacation
     * @param array|null        $pagination
     */
    public function __construct(
        private array $segments,
        private string $broadcasterId,
        private string $broadcasterName,
        private string $broadcasterLogin,
        private array $vacation,
        private ?array $pagination = null
    ) {
    }

    public function getSegments(): array {
        return $this->segments;
    }

    public function getBroadcasterId(): string {
        return $this->broadcasterId;
    }

    public function getBroadcasterName(): string {
        return $this->broadcasterName;
    }

    public function getBroadcasterLogin(): string {
        return $this->broadcasterLogin;
    }

    public function getVacation(): array {
        return $this->vacation;
    }

    public function getPagination(): ?array {
        return $this->pagination;
    }
}
