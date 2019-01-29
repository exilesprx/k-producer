<?php

namespace App\Events\Domain;

use App\Entities\User;

class UserCreated implements DomainContract
{
    private $user;

    private function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function from(User $user) : self
    {
        return new self($user);
    }

    public function getUser() : User
    {
        return $this->user;
    }
}