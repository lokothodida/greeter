<?php

namespace lokothodida\Greeting\UserRepository;

use lokothodida\Greeting\{
    User,
    UserRepository
};

final class CsvFileUserRepository implements UserRepository
{
    private $users = [];

    public function __construct(string $filename)
    {
        $this->loadFromFile($filename);
    }

    public function getByUsername(string $username): User
    {
        if (!isset($this->users[$username])) {
            throw new \Exception(sprintf('User %s not found', $username));
        }

        return $this->users[$username];
    }

    public function loadFromFile(string $filename): void
    {
        $rows = array_map('str_getcsv', file($filename));

        foreach (file($filename) as $line) {
            $row = str_getcsv($line);

            $this->users[$row[0]] = new User($row[0], $row[1], $row[2]);
        }
    }
}
