<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util;

use OpenTelemetry\Distro\Util\StaticClassTrait;
use OpenTelemetry\Distro\Util\TextUtil;
use OpenTelemetry\DistroTests\Util\Log\AdhocLoggableObject;
use OpenTelemetry\DistroTests\Util\Log\LoggableStackTrace;
use OpenTelemetry\DistroTests\Util\Log\LoggableToString;
use OpenTelemetry\DistroTests\Util\Log\PropertyLogPriority;
use OpenTelemetry\DistroTests\Util\Log\SinkForTests as LogSinkForTests;
use Throwable;

/**
 * Code in this file is part of implementation internals, and thus it is not covered by the backward compatibility.
 *
 * @internal
 */
final class ExceptionUtil
{
    use StaticClassTrait;

    /**
     * @param array<string, mixed> $context
     * @param ?non-negative-int    $numberOfStackFramesToSkip PHP_INT_MAX means no stack trace
     */
    public static function buildMessage(string $messagePrefix, array $context = [], ?int $numberOfStackFramesToSkip = null): string
    {
        $messageSuffixObj = new AdhocLoggableObject($context);
        if ($numberOfStackFramesToSkip !== null) {
            $stacktrace = LoggableStackTrace::buildForCurrent($numberOfStackFramesToSkip + 1);
            $messageSuffixObj->addProperties([LoggableStackTrace::STACK_TRACE_KEY => $stacktrace], PropertyLogPriority::MUST_BE_INCLUDED);
        }
        $messageSuffix = LoggableToString::convert($messageSuffixObj, prettyPrint: true);
        return $messagePrefix . (TextUtil::isEmptyString($messageSuffix) ? '' : ('. ' . $messageSuffix));
    }

    /**
     * @template TReturnValue
     *
     * @param callable(): TReturnValue $callableToRun
     *
     * @return TReturnValue
     *
     * @noinspection PhpDocMissingThrowsInspection
     */
    public static function runCatchLogRethrow(callable $callableToRun): mixed
    {
        try {
            return $callableToRun();
        } catch (Throwable $throwable) {
            LogSinkForTests::writeLineToStdErr('Caught throwable: ' . $throwable);
            throw $throwable;
        }
    }
}
