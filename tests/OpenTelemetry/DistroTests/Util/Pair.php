<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;

/**
 * @template TFirst
 * @template TSecond
 */
final class Pair implements LoggableInterface
{
    use LoggableTrait;

    /** @var TFirst */
    public $first;

    /** @var TSecond */
    public $second;

    /**
     * @param TFirst $first
     * @param TSecond $second
     */
    public function __construct($first, $second)
    {
        $this->first = $first;
        $this->second = $second;
    }
}
