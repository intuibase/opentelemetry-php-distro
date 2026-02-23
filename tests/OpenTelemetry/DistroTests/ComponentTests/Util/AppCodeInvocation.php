<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\AmbientContextForTests;
use OpenTelemetry\DistroTests\Util\SystemTime;

final class AppCodeInvocation
{
    /** @var AppCodeHostParams[] */
    public array $appCodeHostsParams;
    public SystemTime $timestampAfter;

    public function __construct(
        public readonly AppCodeRequestParams $appCodeRequestParams,
        public readonly SystemTime $timestampBefore
    ) {
    }

    public function after(): void
    {
        $this->timestampAfter = AmbientContextForTests::clock()->getSystemClockCurrentTime();
    }
}
