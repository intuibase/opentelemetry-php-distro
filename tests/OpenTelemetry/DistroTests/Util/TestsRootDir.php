<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\Util;

use OpenTelemetry\Distro\Util\StaticClassTrait;

final class TestsRootDir
{
    use StaticClassTrait;
    use RootDirTrait;

    public static function getFullPath(): string
    {
        if (self::$fullPath === null) {
            self::$fullPath = RepoRootDir::adaptRelativeUnixStylePath('tests');
        }
        return self::$fullPath;
    }
}
