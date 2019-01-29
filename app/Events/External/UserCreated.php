<?php

namespace App\Events\External;

use App\Entities\User;

class UserCreated implements KafkaContract
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

    public function toArray(): array
    {
        return $this->user->toArray();
    }
}