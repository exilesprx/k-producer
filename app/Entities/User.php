<?php

namespace App\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\UuidInterface;

class User extends Entity implements AuthenticatableContract
{
    use Authorizable, Authenticatable, Notifiable;

    private $name;

    private $email;

    public function __construct(UuidInterface $uuid, string $name, string $email)
    {
        $this->id = $uuid;

        $this->name = $name;

        $this->email = $email;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }

    public function getKeyName(): string
    {
        return 'id';
    }
}