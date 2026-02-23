<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\Util;

use OpenTelemetry\DistroTests\Util\Config\RawSnapshotFromArray;
use OpenTelemetry\DistroTests\Util\Config\RawSnapshotInterface;
use OpenTelemetry\DistroTests\Util\Config\RawSnapshotSourceInterface;
use Override;

final class MockConfigRawSnapshotSource implements RawSnapshotSourceInterface
{
    /** @var array<string, string> */
    private array $optNameToRawValue = [];

    public function set(string $optName, string $optVal): self
    {
        $this->optNameToRawValue[$optName] = $optVal;
        return $this;
    }

    /** @inheritDoc */
    #[Override]
    public function currentSnapshot(array $optionNameToMeta): RawSnapshotInterface
    {
        return new RawSnapshotFromArray($this->optNameToRawValue);
    }
}
