<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

interface ExpectationsInterface
{
    public function assertMatchesMixed(mixed $actual): void;
}
