<?php

namespace lokothodida\Greeting;

final class User
{
    private $username;
    private $firstName;
    private $lastName;

    public function __construct(string $username, string $firstName, string $lastName)
    {
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function username(): string
    {
        return $this->username;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }
}
