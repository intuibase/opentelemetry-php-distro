<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

final class AppCodeTarget
{
    public ?string $appCodeClass = null;
    public ?string $appCodeMethod = null;

    /**
     * @param array{class-string, string} $appCodeClassMethod
     */
    public static function asRouted(array $appCodeClassMethod): AppCodeTarget
    {
        $thisObj = new AppCodeTarget();
        $thisObj->appCodeClass = $appCodeClassMethod[0];
        $thisObj->appCodeMethod = $appCodeClassMethod[1];
        return $thisObj;
    }
}
