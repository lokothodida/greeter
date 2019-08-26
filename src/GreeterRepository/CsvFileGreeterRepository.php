<?php

namespace lokothodida\Greeting\GreeterRepository;

use lokothodida\Greeting\{
    Greeter,
    GreeterRepository,
    Greeter\StringTemplateGreeter
};

final class CsvFileGreeterRepository implements GreeterRepository
{
    private $greeters = [];

    public function __construct(string $filename)
    {
        $this->loadFromFile($filename);
    }

    public function getByLanguage(string $language): Greeter
    {
        if (!isset($this->greeters[$language])) {
            throw new \Exception(sprintf('Language %s not supported', $language));
        }

        return $this->greeters[$language];
    }

    public function loadFromFile(string $filename): void
    {
        $rows = array_map('str_getcsv', file($filename));

        foreach (file($filename) as $line) {
            $row = str_getcsv($line);

            $this->greeters[$row[0]] = new StringTemplateGreeter($row[1], $row[2], $row[3]);
        }
    }
}
