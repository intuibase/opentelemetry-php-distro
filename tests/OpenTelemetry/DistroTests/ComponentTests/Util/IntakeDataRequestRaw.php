<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;
use OpenTelemetry\DistroTests\Util\Log\LogStreamInterface;
use OpenTelemetry\DistroTests\Util\MonotonicTime;
use OpenTelemetry\DistroTests\Util\SystemTime;

/**
 * @phpstan-type HttpHeaders array<string, string[]>
 */
final class IntakeDataRequestRaw extends AgentBackendCommEvent
{
    use LoggableTrait;

    /**
     * @param HttpHeaders $httpHeaders
     */
    public function __construct(
        MonotonicTime $monotonicTime,
        SystemTime $systemTime,
        public readonly OTelSignalType $signalType,
        public readonly array $httpHeaders,
        public readonly string $body,
    ) {
        parent::__construct($monotonicTime, $systemTime);
    }

    /**
     * @return string[]
     */
    protected static function propertiesExcludedFromLog(): array
    {
        return ['body'];
    }

    public function toLog(LogStreamInterface $stream): void
    {
        $customToLog = ['strlen(body)' => strlen($this->body)];
        $this->toLogLoggableTraitImpl($stream, $customToLog);
    }
}
