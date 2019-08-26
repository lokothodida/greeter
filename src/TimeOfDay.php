<?php

namespace lokothodida\Greeting;

use DateTimeImmutable;

final class TimeOfDay
{
    private $time;

    public function __construct(DateTimeImmutable $time)
    {
        $this->time = $time;
    }

    public function isMorning(): bool
    {
        $hour = $this->hourOf($this->time);

        return $hour >= 0 && $hour < 12;
    }

    public function isAfternoon(): bool
    {
        $hour = $this->hourOf($this->time);

        return $hour >= 12 && $hour < 18;
    }

    public function isEvening(): bool
    {
        $hour = $this->hourOf($this->time);

        return $hour >= 18 && $hour <= 23;
    }

    private function hourOf(DateTimeImmutable $time): int
    {
        return (int) $time->format('G');
    }
}