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
abstract class OptionMetadata implements LoggableInterface
{
    use LoggableTrait;

    /**
     * @return OptionParser<TParsedValue>
     */
    abstract public function parser(): OptionParser;

    /**
     * @return null|TParsedValue
     */
    abstract public function defaultValue(): mixed;
}
