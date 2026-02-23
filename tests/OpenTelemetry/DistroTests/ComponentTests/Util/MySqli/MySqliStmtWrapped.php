<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util\MySqli;

use OpenTelemetry\DistroTests\Util\Log\LoggableInterface;
use OpenTelemetry\DistroTests\Util\Log\LoggableTrait;
use mysqli_stmt;

/**
 * Code in this file is part of implementation internals and thus it is not covered by the backward compatibility.
 *
 * @internal
 */
final class MySqliStmtWrapped implements LoggableInterface
{
    use LoggableTrait;

    public function __construct(
        private readonly mysqli_stmt $wrappedObj,
        private readonly bool $isOOPApi
    ) {
    }

    public function bindParam(string $types, mixed &$var, mixed &...$vars): bool
    {
        return $this->isOOPApi
            ? $this->wrappedObj->bind_param($types, $var, ...$vars)
            : mysqli_stmt_bind_param($this->wrappedObj, $types, $var, ...$vars);
    }

    public function execute(): bool
    {
        return $this->isOOPApi
            ? $this->wrappedObj->execute()
            : mysqli_stmt_execute($this->wrappedObj);
    }

    public function close(): bool
    {
        return $this->isOOPApi
            ? $this->wrappedObj->close()
            : mysqli_stmt_close($this->wrappedObj);
    }
}
