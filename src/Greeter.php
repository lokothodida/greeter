<?php

namespace lokothodida\Greeting;

interface Greeter
{
    public function sayGoodMorning(User $user): string;
    public function sayGoodAfternoon(User $user): string;
    public function sayGoodEvening(User $user): string;
}
