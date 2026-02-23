<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\AmbientContextForTests;
use OpenTelemetry\DistroTests\Util\Clock;
use OpenTelemetry\DistroTests\Util\MonotonicTime;
use OpenTelemetry\DistroTests\Util\TimeUtil;

final class Stopwatch
{
    private readonly Clock $clock;
    private MonotonicTime $timeStarted;

    public function __construct()
    {
        $this->clock = AmbientContextForTests::clock();
        $this->restart();
    }

    public function elapsedInMicroseconds(): float
    {
        return TimeUtil::calcDurationInMicrosecondsClampNegativeToZero($this->timeStarted, $this->clock->getMonotonicClockCurrentTime());
    }

    public function restart(): void
    {
        $this->timeStarted = $this->clock->getMonotonicClockCurrentTime();
    }
}
