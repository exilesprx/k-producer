<?php

namespace App\Entities;

interface EntityContract
{
    public function sameIdentityAs(EntityContract $comparable): bool;
}