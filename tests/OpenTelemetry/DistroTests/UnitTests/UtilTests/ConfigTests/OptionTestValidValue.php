<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\UtilTests\ConfigTests;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;

/**
 * @template TParsedValue
 */
final class OptionTestValidValue implements LoggableInterface
{
    use LoggableTrait;

    public string $rawValue;

    /** @var TParsedValue */
    public mixed $parsedValue;

    /**
     * @param TParsedValue $parsedValue
     */
    public function __construct(string $rawValue, $parsedValue)
    {
        $this->rawValue = $rawValue;
        $this->parsedValue = $parsedValue;
    }
}
