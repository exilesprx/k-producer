<?php

namespace App\ValueObjects\Logzio;

class LogzioType
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}