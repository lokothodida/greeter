<?php

namespace lokothodida\Greeting;

interface GreeterRepository
{
    public function getByLanguage(string $language): Greeter;
}
