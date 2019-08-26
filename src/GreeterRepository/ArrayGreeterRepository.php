<?php

namespace lokothodida\Greeting\GreeterRepository;

use lokothodida\Greeting\{Greeter, GreeterRepository};

final class ArrayGreeterRepository implements GreeterRepository
{
    private $greeters = [];

    public function getByLanguage(string $language): Greeter
    {
        if (!isset($this->greeters[$language])) {
            throw new \Exception(sprintf('Language %s not supported', $language));
        }

        return $this->greeters[$language];
    }

    public function add(string $language, Greeter $greeter): void
    {
        $this->greeters[$language] = $greeter;
    }
}
