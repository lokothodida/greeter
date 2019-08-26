<?php

namespace lokothodida\Greeting\Greeter;

use lokothodida\Greeting\{Greeter, User};

final class SimpleEnglishGreeter implements Greeter
{
    public function sayGoodMorning(User $user): string
    {
        return sprintf('Good morning, %s!', $user->firstName());
    }

    public function sayGoodAfternoon(User $user): string
    {
        return sprintf('Good afternoon, %s!', $user->firstName());
    }

    public function sayGoodEvening(User $username): string
    {
        return sprintf('Good evening, %s!', $user->firstName());
    }
}
