<?php

namespace App\Events;

use Illuminate\Contracts\Support\Jsonable;

interface LogableEvent extends Jsonable
{
    public function toJson($options = 0) : string;
}