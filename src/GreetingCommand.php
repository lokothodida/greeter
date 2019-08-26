<?php

namespace lokothodida\Greeting;

use DateTimeImmutable;

final class GreetingCommand
{
    private $clock;
    private $greeters;
    private $users;

    public function __construct(
        Clock $clock,
        GreeterRepository $greeters,
        UserRepository $users
    ) {
        $this->clock = $clock;
        $this->greeters = $greeters;
        $this->users = $users;
    }

    public function __invoke(string $username, string $language): string
    {
        $time = $this->clock->now();
        $greeter = $this->greeters->getByLanguage($language);
        $user = $this->users->getByUsername($username);

        if ($time->isMorning()) {
            return $greeter->sayGoodMorning($user);
        } elseif ($time->isAfternoon()) {
            return $greeter->sayGoodAfternoon($user);
        } else {
            return $greeter->sayGoodEvening($user);
        }
    }
}
