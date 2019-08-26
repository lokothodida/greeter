<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Greeting\TimeOfDay;

final class TimeOfDayTest extends TestCase
{
    /**
     * @dataProvider morningTimes
     */
    public function test0000amTo1159amIsMorningOnly(DateTimeImmutable $time): void
    {
        $timeOfDay = new TimeofDay($time);
        $this->assertTrue($timeOfDay->isMorning());
        $this->assertFalse($timeOfDay->isAfternoon());
        $this->assertFalse($timeOfDay->isEvening());
    }

    /**
     * @dataProvider afternoonTimes
     */
    public function test1200pmTo1759pmIsAfternoonOnly(DateTimeImmutable $time): void
    {
        $timeOfDay = new TimeofDay($time);
        $this->assertFalse($timeOfDay->isMorning());
        $this->assertTrue($timeOfDay->isAfternoon());
        $this->assertFalse($timeOfDay->isEvening());
    }

    /**
     * @dataProvider eveningTimes
     */
    public function test1800pmTo2359pmIsEveningOnly(DateTimeImmutable $time): void
    {
        $timeOfDay = new TimeofDay($time);
        $this->assertFalse($timeOfDay->isMorning());
        $this->assertFalse($timeOfDay->isAfternoon());
        $this->assertTrue($timeOfDay->isEvening());
    }

    public function morningTimes(): array
    {
        return $this->timeRange(0, 12);
    }

    public function afternoonTimes(): array
    {
        return $this->timeRange(12, 18);
    }

    public function eveningTimes(): array
    {
        return $this->timeRange(18, 24);
    }

    private function timeRange(int $startHour, $endHour): array
    {
        $times = [];

        for ($i = $startHour; $i < $endHour; $i++) {
            for ($j = 0; $j < 60; $j++) {
                $time = new DateTimeImmutable(sprintf('2019-01-01 %s:%s:00', $i, $j));
                $times[$time->format('H:i')] = [new DateTimeImmutable(sprintf('2019-01-01 %s:%s:00', $i, $j))];
            }
        }

        return $times;
    }
}
