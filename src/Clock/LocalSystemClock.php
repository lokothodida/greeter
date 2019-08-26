<?php

namespace lokothodida\Greeting\Clock;

use lokothodida\Greeting\{Clock, TimeOfDay};
use DateTimeImmutable;

final class LocalSystemClock implements Clock
{
    public function now(): TimeOfDay
    {
        return new TimeOfDay(new DateTimeImmutable());
    }
}
