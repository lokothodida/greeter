<?php

namespace lokothodida\Greeting\Greeter;

use lokothodida\Greeting\{Greeter, User};

final class StringTemplateGreeter implements Greeter
{
    private $morningText;
    private $afternoonText;
    private $eveningText;

    public function __construct(
        string $morningText,
        string $afternoonText,
        string $eveningText
    ) {
        $this->morningText = $morningText;
        $this->afternoonText = $afternoonText;
        $this->eveningText = $eveningText;
    }

    public function sayGoodMorning(User $user): string
    {
        return $this->replaceVariables($this->morningText, $user);
    }

    public function sayGoodAfternoon(User $user): string
    {
        return $this->replaceVariables($this->afternoonText, $user);
    }

    public function sayGoodEvening(User $user): string
    {
        return $this->replaceVariables($this->eveningText, $user);
    }

    private function replaceVariables(string $text, User $user): string
    {
        return str_replace(
            ['{{userName}}', '{{firstName}}', '{{lastName}}'],
            [$user->username(), $user->firstName(), $user->lastName()],
            $text
        );
    }
}
