<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util\Config;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;

/**
 * Code in this file is part of implementation internals, and thus it is not covered by the backward compatibility.
 *
 * @internal
 *
 * @template TParsedValue
 */
abstract class OptionParser implements LoggableInterface
{
    use LoggableTrait;

    /**
     * @return TParsedValue
     *
     * @throws ParseException
     */
    abstract public function parse(string $rawValue): mixed;
}
