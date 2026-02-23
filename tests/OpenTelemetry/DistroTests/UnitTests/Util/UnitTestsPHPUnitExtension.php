<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\Util;

use OpenTelemetry\DistroTests\Util\OTelDistroExtensionUtil;
use OpenTelemetry\DistroTests\Util\PHPUnitExtensionBase;
use OpenTelemetry\DistroTests\Util\TestsInfraException;

/**
 * @noinspection PhpUnused
 *
 * Referenced in PHPUnit's configuration file - phpunit.xml
 */
final class UnitTestsPHPUnitExtension extends PHPUnitExtensionBase
{
    public function __construct()
    {
        parent::__construct();

        if (OTelDistroExtensionUtil::isLoaded()) {
            throw new TestsInfraException(OTelDistroExtensionUtil::EXTENSION_NAME . ' should NOT be loaded when running unit tests because it will cause a clash');
        }
    }
}
