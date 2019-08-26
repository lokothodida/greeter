<?php

namespace lokothodida\Greeting;

interface Clock
{
    public function now(): TimeOfDay;
}
