<?php

namespace lokothodida\Greeting;

interface UserRepository
{
    public function getByUsername(string $username): User;
}
