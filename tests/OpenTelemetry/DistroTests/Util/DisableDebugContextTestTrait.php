<?php

/** @noinspection PhpPluralMixedCanBeReplacedWithArrayInspection */

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util;

use Override;

trait DisableDebugContextTestTrait
{
    #[Override]
    protected function shouldDebugContextBeEnabledForThisTest(): bool
    {
        return false;
    }
}
