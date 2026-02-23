<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;
use OpenTelemetry\DistroTests\Util\MonotonicTime;
use OpenTelemetry\DistroTests\Util\SystemTime;

abstract class AgentBackendCommEvent implements LoggableInterface
{
    use LoggableTrait;

    public function __construct(
        public readonly MonotonicTime $monotonicTime,
        public readonly SystemTime $systemTime,
    ) {
    }
}
