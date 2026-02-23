<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

interface IsEnoughAgentBackendCommsInterface
{
    public function isEnough(AgentBackendComms $comms): bool;
}
