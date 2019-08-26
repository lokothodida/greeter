<?php

require __DIR__ . '/../vendor/autoload.php';

use lokothodida\Greeting\{
    GreetingCommand,
    Clock\LocalSystemClock,
    Clock\FrozenClock,
    Greeter\SimpleEnglishGreeter,
    Greeter\StringTemplateGreeter,
    GreeterRepository\AlwaysSameGreeter,
    GreeterRepository\CsvFileGreeterRepository,
    UserRepository\CsvFileUserRepository
};

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

$container = [
    'local_system_clock' => new LocalSystemClock(),
    'frozen_clock' => new FrozenClock(new DateTimeImmutable(getenv('FROZEN_CLOCK_TIME'))),
    'csv_file_greeter_repository' => new CsvFileGreeterRepository(realpath(getenv('GREETINGS_CSV_FILE'))),
    'csv_file_user_repository' => new CsvFileUserRepository(realpath(getenv('USERS_CSV_FILE'))),
];

$container['clock'] = $container[getenv('CLOCK')];
$container['greeter_repository'] = $container[getenv('GREETER_REPOSITORY')];
$container['user_repository'] = $container[getenv('USER_REPOSITORY')];

$container['greet'] = new GreetingCommand(
    $container['clock'],
    $container['greeter_repository'],
    $container['user_repository']
);

return $container;
