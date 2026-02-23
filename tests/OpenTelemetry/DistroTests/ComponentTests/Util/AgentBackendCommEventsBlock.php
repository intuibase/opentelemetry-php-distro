<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

final class AgentBackendCommEventsBlock
{
    /**
     * @param list<AgentBackendCommEvent> $events
     */
    public function __construct(
        public array $events
    ) {
    }
}
