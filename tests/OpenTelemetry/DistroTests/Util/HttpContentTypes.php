<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util;

use OpenTelemetry\Distro\Util\StaticClassTrait;

/**
 * Code in this file is part of implementation internals, and thus it is not covered by the backward compatibility.
 *
 * @internal
 */
final class HttpContentTypes
{
    use StaticClassTrait;

    public const PROTOBUF = 'application/x-protobuf';
    public const JSON = 'application/json';
    public const TEXT = 'text/plain';
}
