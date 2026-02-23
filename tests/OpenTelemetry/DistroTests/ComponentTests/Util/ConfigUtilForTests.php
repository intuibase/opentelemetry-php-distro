<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\Distro\PhpPartFacade;
use OpenTelemetry\Distro\Util\BoolUtil;
use OpenTelemetry\Distro\Util\StaticClassTrait;
use OpenTelemetry\DistroTests\Util\Config\ConfigSnapshotForTests;
use OpenTelemetry\DistroTests\Util\Config\OptionForProdName;
use OpenTelemetry\DistroTests\Util\Config\OptionsForTestsMetadata;
use OpenTelemetry\DistroTests\Util\Config\Parser;
use OpenTelemetry\DistroTests\Util\Config\RawSnapshotSourceInterface;
use OpenTelemetry\DistroTests\Util\OTelDistroExtensionUtil;
use OpenTelemetry\DistroTests\Util\Log\LoggerFactory;
use OpenTelemetry\DistroTests\Util\TestsInfraException;

use function OpenTelemetry\Distro\is_enabled;

final class ConfigUtilForTests
{
    use StaticClassTrait;

    public const PROD_DISABLED_INSTRUMENTATIONS_ALL = 'all';

    public static function read(RawSnapshotSourceInterface $configSource, LoggerFactory $loggerFactory): ConfigSnapshotForTests
    {
        $parser = new Parser($loggerFactory);
        $allOptsMeta = OptionsForTestsMetadata::get();
        $optNameToParsedValue = $parser->parse($allOptsMeta, $configSource->currentSnapshot($allOptsMeta));
        return new ConfigSnapshotForTests($optNameToParsedValue);
    }

    public static function verifyTracingIsDisabled(): void
    {
        if (!OTelDistroExtensionUtil::isLoaded()) {
            return;
        }

        $envVarName = OptionForProdName::enabled->toEnvVarName();
        $envVarValue = EnvVarUtilForTests::get($envVarName);
        if ($envVarValue !== 'false') {
            throw new TestsInfraException(
                'Environment variable ' . $envVarName . ' should be set to `false\'.'
                . ' Instead it is ' . ($envVarValue === null ? 'not set' : 'set to `' . $envVarValue . '\'')
            );
        }

        $msgPrefix = 'Component tests auxiliary processes should not be recorded';
        // OpenTelemetry\Distro\is_enabled is provided by the extension
        if (function_exists('OpenTelemetry\Distro\is_enabled') && is_enabled()) {
            throw new ComponentTestsInfraException($msgPrefix . '; OpenTelemetry\Distro\is_enabled() returned true');
        }
        if (PhpPartFacade::$wasBootstrapCalled) {
            throw new ComponentTestsInfraException($msgPrefix . '; PhpPartFacade::$wasBootstrapCalled is true');
        }
    }

    public static function optionValueToString(string|int|float|bool $optVal): string
    {
        if (is_string($optVal)) {
            return $optVal;
        }

        if (is_bool($optVal)) {
            return BoolUtil::toString($optVal);
        }

        return strval($optVal);
    }
}
