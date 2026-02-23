<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\EnumUtilForTestsTrait;

enum OTelSignalType
{
    use EnumUtilForTestsTrait;

    case trace;
    case metric;
    case log;
    case baggage;
}
