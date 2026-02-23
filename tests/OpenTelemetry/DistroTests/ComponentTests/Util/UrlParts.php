<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;

/**
 * Code in this file is part of implementation internals and thus it is not covered by the backward compatibility.
 *
 * @internal
 */
final class UrlParts implements LoggableInterface
{
    use LoggableTrait;

    public function __construct(
        public ?string $scheme = null,
        public ?string $host = null,
        public ?int $port = null,
        public ?string $path = null,
        public ?string $query = null,
    ) {
    }

    public function __toString(): string
    {
        return '{'
               . 'path: ' . $this->path
               . ', '
               . 'query: ' . $this->query
               . '}';
    }
}
