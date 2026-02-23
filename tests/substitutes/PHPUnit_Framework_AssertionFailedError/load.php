<?php

declare(strict_types=1);

use OpenTelemetry\DistroTests\substitutes\PHPUnitFrameworkAssertionFailedErrorAutoloader;
use OpenTelemetry\DistroTests\substitutes\SubstitutesUtil;
use PHPUnit\Framework\AssertionFailedError;

require __DIR__ . '/PHPUnitFrameworkAssertionFailedErrorAutoloader.php';

SubstitutesUtil::assertClassNotLoaded(AssertionFailedError::class, autoload: false);
PHPUnitFrameworkAssertionFailedErrorAutoloader::register();
SubstitutesUtil::assertClassLoaded(AssertionFailedError::class, autoload: true);

SubstitutesUtil::assertClassHasProperty(AssertionFailedError::class, 'preprocessMessage');
