<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;
use OpenTelemetry\DistroTests\Util\MixedMap;

class AppCodeRequestParams implements LoggableInterface
{
    use LoggableTrait;

    public TestInfraDataPerRequest $dataPerRequest;

    public function __construct(string $spawnedProcessInternalId, AppCodeTarget $appCodeTarget)
    {
        $this->dataPerRequest = new TestInfraDataPerRequest(spawnedProcessInternalId: $spawnedProcessInternalId, appCodeTarget: $appCodeTarget);
    }

    /**
     * @param MixedMap|array<string, mixed> $appCodeArgs
     */
    public function setAppCodeArgs(MixedMap|array $appCodeArgs): void
    {
        $this->dataPerRequest->appCodeArguments = $appCodeArgs instanceof MixedMap ? $appCodeArgs->cloneAsArray() : $appCodeArgs;
    }

    /** @noinspection PhpUnused */
    public function setIsAppCodeExpectedToThrow(bool $isAppCodeExpectedToThrow): void
    {
        $this->dataPerRequest->isAppCodeExpectedToThrow = $isAppCodeExpectedToThrow;
    }
}
