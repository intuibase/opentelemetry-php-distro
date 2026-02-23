<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util;

use OpenTelemetry\Distro\Util\SingletonInstanceTrait;
use OpenTelemetry\DistroTests\Util\Log\LogConsts;
use OpenTelemetry\DistroTests\Util\Log\LogStreamInterface;

/**
 * Code in this file is part of implementation internals and thus it is not covered by the backward compatibility.
 *
 * @internal
 */
trait NoopObjectTrait
{
    use SingletonInstanceTrait;

    public function isNoop(): bool
    {
        return true;
    }

    public function toLog(LogStreamInterface $stream): void
    {
        $stream->toLogAs([LogConsts::TYPE_KEY => ClassNameUtil::fqToShort(get_class($this))]);
    }
}
