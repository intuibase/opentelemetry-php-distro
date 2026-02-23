<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util;

/**
 * Code in this file is part of implementation internals, and thus it is not covered by the backward compatibility.
 *
 * @internal
 */
final class MonotonicTime
{
    public function __construct(
        public readonly float $value
    ) {
    }
}
