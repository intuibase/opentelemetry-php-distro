<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

final class AgentBackendConnection
{
    /**
     * @param IntakeDataRequestDeserialized[] $requests
     */
    public function __construct(
        public readonly AgentBackendConnectionStarted $started,
        public readonly array $requests
    ) {
    }
}
