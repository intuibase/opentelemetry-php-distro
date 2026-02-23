<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;

abstract class IntakeDataRequestDeserialized implements LoggableInterface
{
    use LoggableTrait;

    protected function __construct(
        public readonly IntakeDataRequestRaw $raw,
    ) {
    }

    abstract public function isEmptyAfterDeserialization(): bool;
}
