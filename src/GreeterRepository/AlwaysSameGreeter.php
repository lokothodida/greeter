<?php

namespace lokothodida\Greeting\GreeterRepository;

use lokothodida\Greeting\{Greeter, GreeterRepository};

final class AlwaysSameGreeter implements GreeterRepository
{
    private $greeter;

    public function __construct(Greeter $greeter)
    {
        $this->greeter = $greeter;
    }

    public function getByLanguage(string $language): Greeter
    {
        return $this->greeter;
    }
}
