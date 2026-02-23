<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use Closure;
use OpenTelemetry\DistroTests\Util\AmbientContextForTests;
use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;

abstract class AppCodeHostHandle implements LoggableInterface
{
    use LoggableTrait;

    public function __construct(
        protected readonly TestCaseHandle $testCaseHandle,
        public readonly AppCodeHostParams $appCodeHostParams,
    ) {
    }

    /**
     * @param null|Closure(AppCodeRequestParams): void $setParamsFunc
     */
    abstract public function execAppCode(AppCodeTarget $appCodeTarget, ?Closure $setParamsFunc = null): void;

    protected function beforeAppCodeInvocation(AppCodeRequestParams $appCodeRequestParams): AppCodeInvocation
    {
        $timestampBefore = AmbientContextForTests::clock()->getSystemClockCurrentTime();
        return new AppCodeInvocation($appCodeRequestParams, $timestampBefore);
    }

    protected function afterAppCodeInvocation(AppCodeInvocation $appCodeInvocation): void
    {
        $appCodeInvocation->after();
        $this->testCaseHandle->addAppCodeInvocation($appCodeInvocation);
    }

    /**
     * @return string[]
     */
    protected static function propertiesExcludedFromLog(): array
    {
        return ['testCaseHandle'];
    }
}
