<?php

require __DIR__ . '/../vendor/autoload.php';

use lokothodida\Greeting\{
    GreetingCommand,
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
    'frozen_clock' => new FrozenClock(new DateTimeImmutable('2019-01-01 18:00:00')),
    'csv_file_greeter_repository' => new CsvFileGreeterRepository(__DIR__ . '/../data/greetings.csv'),
    'csv_file_user_repository' => new CsvFileUserRepository(__DIR__ . '/../data/users.csv'),
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
