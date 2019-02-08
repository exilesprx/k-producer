<?php

namespace App\ValueObjects\Logzio;

class LogzioToken
{
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function __toString(): string
    {
        return $this->token;
    }
}