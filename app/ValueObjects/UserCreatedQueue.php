<?php

namespace App\ValueObjects;

class UserCreatedQueue
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