<?php

namespace App\Events\External;

use App\Entities\UnverifiedUser;

class UserCreated implements KafkaContract
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

    public function toArray(): array
    {
        return $this->user->toArray();
    }
}