<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\ComponentTests\Util\OtlpData\Span;
use OpenTelemetry\DistroTests\ComponentTests\Util\OtlpData\SpanKind;

final class SpanExpectations implements ExpectationsInterface
{
    use ExpectationsTrait;

    /**
     * @phpstan-param LeafExpectations<SpanKind> $kind
     */
    public function __construct(
        public readonly StringExpectations $name,
        public readonly LeafExpectations $kind,
        public readonly AttributesExpectations $attributes,
    ) {
    }

    public function assertMatches(Span $actual): void
    {
        $this->assertMatchesMixed($actual);
    }
}
