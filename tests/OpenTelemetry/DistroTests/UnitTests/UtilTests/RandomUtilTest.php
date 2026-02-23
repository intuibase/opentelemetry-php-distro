<?php

/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\UtilTests;

use OpenTelemetry\DistroTests\Util\AssertEx;
use OpenTelemetry\DistroTests\Util\Log\LoggableToString;
use OpenTelemetry\DistroTests\Util\RandomUtil;
use OpenTelemetry\DistroTests\Util\TestCaseBase;

class RandomUtilTest extends TestCaseBase
{
    public function testArrayRandValues(): void
    {
        self::assertSame([], RandomUtil::arrayRandValues([], 0));
        self::assertSame([], RandomUtil::arrayRandValues(['a'], 0));
        self::assertSame(['a'], RandomUtil::arrayRandValues(['a'], 1));

        $totalSet = ['a', 'b'];
        $randSelectedSubSet = RandomUtil::arrayRandValues($totalSet, 1);
        self::assertTrue(
            $randSelectedSubSet == ['a'] || $randSelectedSubSet == ['b'],
            LoggableToString::convert(['$randSelectedSubSet' => $randSelectedSubSet])
        );
        AssertEx::listIsSubsetOf($randSelectedSubSet, $totalSet);
        self::assertEqualsCanonicalizing($totalSet, RandomUtil::arrayRandValues($totalSet, count($totalSet)));

        $totalSet = ['a', 'b', 'c'];
        $randSelectedSubSet = RandomUtil::arrayRandValues($totalSet, 1);
        self::assertCount(1, $randSelectedSubSet);
        self::assertTrue(
            $randSelectedSubSet == ['a'] || $randSelectedSubSet == ['b'] || $randSelectedSubSet == ['c'],
            LoggableToString::convert(['$randSelectedSubSet' => $randSelectedSubSet])
        );
        AssertEx::listIsSubsetOf($randSelectedSubSet, $totalSet);
        $randSelectedSubSet = RandomUtil::arrayRandValues($totalSet, 2);
        self::assertCount(2, $randSelectedSubSet);
        AssertEx::listIsSubsetOf($randSelectedSubSet, $totalSet);
        self::assertEqualsCanonicalizing($totalSet, RandomUtil::arrayRandValues($totalSet, count($totalSet)));
    }
}
