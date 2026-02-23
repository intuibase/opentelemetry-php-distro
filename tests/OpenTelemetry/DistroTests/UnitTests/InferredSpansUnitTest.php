<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests;

use OpenTelemetry\Distro\InferredSpans\InferredSpans;
use OpenTelemetry\DistroTests\ComponentTests\Util\InferredSpanExpectationsBuilder;
use OpenTelemetry\DistroTests\Util\TestCaseBase;

final class InferredSpansUnitTest extends TestCaseBase
{
    public function testInferredAttributeName(): void
    {
        self::assertSame(InferredSpans::IS_INFERRED_ATTRIBUTE_NAME, InferredSpanExpectationsBuilder::IS_INFERRED_ATTRIBUTE_NAME); // @phpstan-ignore staticMethod.alreadyNarrowedType
    }
}
