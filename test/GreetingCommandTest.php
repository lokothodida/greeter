<?php

use PHPUnit\Framework\TestCase;
use lokothodida\Greeting\{
    GreetingCommand,
    Clock\FrozenClock,
    GreeterRepository\AlwaysSameGreeter,
    GreeterRepository\ArrayGreeterRepository,
    Greeter\StringTemplateGreeter,
    UserRepository\ArrayUserRepository,
    User
};

final class GreetingCommandTest extends TestCase
{
    public function testItGivesMorningGreetingInTheMorning(): void
    {
        $greet = new GreetingCommand(
            new FrozenClock(new DateTimeImmutable('2019-01-01 06:00:00')),
            new AlwaysSameGreeter(new StringTemplateGreeter(
                'Good morning',
                'Good afternoon',
                'Good evening'
            )),
            new ArrayUserRepository(
                new User('user1', 'User', 'One')
            )
        );

        $this->assertSame('Good morning', $greet('user1', 'lang'));
    }

    public function testItGivesAfternoonGreetingInTheAfternoon(): void
    {
        $greet = new GreetingCommand(
            new FrozenClock(new DateTimeImmutable('2019-01-01 13:00:00')),
            new AlwaysSameGreeter(new StringTemplateGreeter(
                'Good morning',
                'Good afternoon',
                'Good evening'
            )),
            new ArrayUserRepository(
                new User('user1', 'User', 'One')
            )
        );

        $this->assertSame('Good afternoon', $greet('user1', 'lang'));
    }

    /**
     * @dataProvider usersAndLanguages
     */
    public function testItGivesEveningGreetingToUserInTheEvening(string $username, string $language): void
    {
        $clock = new FrozenClock(new DateTimeImmutable('2019-01-01 21:00:00'));
        $users = new ArrayUserRepository(
            new User('user1', 'User1', 'One'),
            new User('user2', 'User2', 'Two'),
            new User('user3', 'User3', 'One')
        );

        $greeters = new ArrayGreeterRepository();
        $greeters->add('lang1', new StringTemplateGreeter(
            '',
            '',
            'lang1. Good evening {{userName}}'
        ));
        $greeters->add('lang2', new StringTemplateGreeter(
            '',
            '',
            'lang2. Good evening {{userName}}'
        ));
        $greeters->add('lang3', new StringTemplateGreeter(
            '',
            '',
            'lang3. Good evening {{userName}}'
        ));

        $greet = new GreetingCommand(
            $clock,
            $greeters,
            $users
        );

        $this->assertSame($language . '. Good evening ' . $username, $greet($username, $language));
    }

    public function usersAndLanguages(): array
    {
        $data = [];

        foreach (['user1', 'user2', 'user3'] as $user) {
            foreach (['lang1', 'lang2', 'lang3'] as $language) {
                $data[sprintf('User %s, language %s', $user, $language)] = [$user, $language];
            }
        }

        return $data;
    }
}
