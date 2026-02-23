<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\UtilTests\LogTests;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;

class ObjectWithResourceForTests implements LoggableInterface
{
    use LoggableTrait;

    /** @var resource */
    private $resourceField; // @phpstan-ignore property.unused
}
