<?php

declare(strict_types=1);

namespace SimplyStream\TwitchApiBundle\Clock;

use DateTimeImmutable;
use SimplyStream\TwitchApi\EventSub\Clock\ClockInterface;

final readonly class SystemClock implements ClockInterface
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
