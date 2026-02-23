<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\Util;

final class SourceCodeLocation
{
    public function __construct(
        public string $fileName,
        public int $lineNumber,
    ) {
    }
}
