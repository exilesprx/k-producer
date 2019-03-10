<?php

namespace App\Events\External;

use App\Entities\UnverifiedUser;
use App\Events\LogableEvent;

class UserCreated implements KafkaContract, LogableEvent
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
        return [
            'name' => $this->user->getName(),
            'email' => $this->user->getEmail()
        ];
    }

    public function getName(): string
    {
        $path = explode('\\', self::class);

        return array_pop($path);
    }

    public function toJson($options = 0) : string
    {
        return json_encode(
            [
                'event' => $this->getName(),
                'data' => $this->toArray()
            ]
        );
    }
}