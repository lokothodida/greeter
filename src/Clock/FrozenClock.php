<?php

namespace lokothodida\Greeting\Clock;

use lokothodida\Greeting\{Clock, TimeOfDay};
use DateTimeImmutable;

final class FrozenClock implements Clock
{
    private $time;

    public function __construct(DateTimeImmutable $time)
    {
        $this->time = new TimeOfDay($time);
    }

    public function now(): TimeOfDay
    {
        return $this->time;
    }
}
