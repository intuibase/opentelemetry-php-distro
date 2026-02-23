<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\Util;

use OpenTelemetry\Distro\Log\LogLevel;
use OpenTelemetry\DistroTests\Util\Log\SinkBase;
use Override;

class MockLogPreformattedSink extends SinkBase
{
    /** @var MockLogPreformattedSinkStatement[] */
    public array $consumed = [];

    #[Override]
    protected function consumePreformatted(
        LogLevel $statementLevel,
        string $category,
        string $srcCodeFile,
        int $srcCodeLine,
        string $srcCodeFunc,
        string $messageWithContext
    ): void {
        $this->consumed[] = new MockLogPreformattedSinkStatement(
            $statementLevel,
            $category,
            $srcCodeFile,
            $srcCodeLine,
            $srcCodeFunc,
            $messageWithContext
        );
    }
}
