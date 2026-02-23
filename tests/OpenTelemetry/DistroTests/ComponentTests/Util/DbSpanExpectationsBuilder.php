<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\ComponentTests\Util;

use OpenTelemetry\DistroTests\ComponentTests\Util\OtlpData\SpanKind;
use OpenTelemetry\DistroTests\Util\AssertEx;
use OpenTelemetry\SemConv\TraceAttributes;

class DbSpanExpectationsBuilder extends SpanExpectationsBuilder
{
    public function __construct()
    {
        parent::__construct();

        $this->kind(SpanKind::client);
    }

    /**
     * @return $this
     */
    public function dbSystemName(string $value): self
    {
        return $this->addAttribute(TraceAttributes::DB_SYSTEM_NAME, $value);
    }

    /**
     * @return $this
     */
    public function dbNamespace(string $value): self
    {
        return $this->addAttribute(TraceAttributes::DB_NAMESPACE, $value);
    }

    /**
     * @return $this
     */
    public function dbQueryText(string $value): self
    {
        return $this->addAttribute(TraceAttributes::DB_QUERY_TEXT, $value);
    }

    /**
     * @return $this
     */
    public function dbOperationName(string $value): self
    {
        return $this->addAttribute(TraceAttributes::DB_OPERATION_NAME, $value);
    }

    /**
     * @return $this
     */
    public function dbQueryTextAndOperationName(string $value): self
    {
        return $this->dbQueryText($value)->dbOperationName(self::extractDbOperationNameFromQueryText($value));
    }

    /**
     * @return $this
     */
    public function optionalDbQueryText(?string $dbQueryText): self
    {
        if ($dbQueryText !== null) {
            return $this->dbQueryText($dbQueryText);
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function optionalDbQueryTextAndOperationName(?string $dbQueryText): self
    {
        if ($dbQueryText !== null) {
            return $this->dbQueryTextAndOperationName($dbQueryText);
        }
        return $this;
    }

    private static function extractDbOperationNameFromQueryText(string $dbQueryText): string
    {
        $words = explode(' ', $dbQueryText, limit: 2);
        AssertEx::countAtLeast(1, $words);
        return $words[0];
    }
}
