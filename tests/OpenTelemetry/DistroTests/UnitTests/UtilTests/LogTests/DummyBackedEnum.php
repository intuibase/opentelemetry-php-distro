<?php

declare(strict_types=1);

namespace OpenTelemetry\DistroTests\UnitTests\UtilTests\LogTests;

enum DummyBackedEnum: string
{
    case hearts = 'H';
    case diamonds = 'D';
    case clubs = 'C';
    case spades = 'S';
}
