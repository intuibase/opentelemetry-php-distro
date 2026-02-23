<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

final class TestInfraDataPerProcess
{
    /**
     * @param int[] $thisServerPorts
     */
    public function __construct(
        public readonly int $rootProcessId,
        public readonly ?string $resourcesCleanerSpawnedProcessInternalId,
        public readonly ?int $resourcesCleanerPort,
        public readonly string $thisSpawnedProcessInternalId,
        public readonly array $thisServerPorts,
    ) {
    }
}
