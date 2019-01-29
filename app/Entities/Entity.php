<?php

namespace App\Entities;

use Illuminate\Contracts\Support\Arrayable;

abstract class Entity implements EntityContract, Arrayable
{
    protected $id;

    public function sameIdentityAs(EntityContract $comparable): bool
    {
        return ($comparable instanceof static) &&
            $comparable->id == $this->id;
    }
}