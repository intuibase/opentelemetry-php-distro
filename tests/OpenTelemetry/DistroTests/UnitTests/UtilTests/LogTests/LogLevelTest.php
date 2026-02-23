<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\UtilTests\LogTests;

use OpenTelemetry\Distro\Log\LogLevel;
use OpenTelemetry\DistroTests\Util\Log\LogLevelUtil;
use OpenTelemetry\DistroTests\Util\TestCaseBase;

class LogLevelTest extends TestCaseBase
{
    public function testGetHighest(): void
    {
        self::assertSame(LogLevel::trace, LogLevelUtil::getHighest());
    }
}
