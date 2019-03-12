<?php

namespace App\ValueObjects;

class ApplicationQueue
{
    private $name;

    public function __construct(string  $name)
    {
        $this->name = $name;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}