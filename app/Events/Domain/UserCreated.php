<?php

namespace App\Events\Domain;

use App\Entities\UnverifiedUser;

class UserCreated implements DomainContract
{
    private $user;

    private function __construct(UnverifiedUser $user)
    {
        $this->user = $user;
    }

    public static function from(UnverifiedUser $user) : self
    {
        return new self($user);
    }

    public function getUser() : UnverifiedUser
    {
        return $this->user;
    }
}