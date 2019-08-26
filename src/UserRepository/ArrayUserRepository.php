<?php

namespace lokothodida\Greeting\UserRepository;

use lokothodida\Greeting\{
    User,
    UserRepository
};

final class ArrayUserRepository implements UserRepository
{
    private $users = [];

    public function __construct(User ...$users)
    {
        foreach ($users as $user) {
            $this->users[$user->username()] = $user;
        }
    }

    public function getByUsername(string $username): User
    {
        if (!isset($this->users[$username])) {
            throw new \Exception(sprintf('User %s not found', $username));
        }

        return $this->users[$username];
    }
}
