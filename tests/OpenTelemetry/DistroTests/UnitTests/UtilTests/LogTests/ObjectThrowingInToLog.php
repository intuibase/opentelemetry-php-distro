<?php

/** @noinspection PhpUnusedPrivateFieldInspection */

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\UtilTests\LogTests;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LogStreamInterface;
use RuntimeException;

class ObjectThrowingInToLog implements LoggableInterface
{
    public function toLog(LogStreamInterface $stream): void
    {
        throw new RuntimeException('Dummy thrown on purpose');
    }
}
