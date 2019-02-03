<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\UuidInterface;

class User extends Entity implements AuthenticatableContract, MustVerifyEmailContract
{
    use Authorizable, Authenticatable, MustVerifyEmail, Notifiable;

    private $name;

    private $email;

    private $emailVerifiedAt;

    public function __construct(UuidInterface $uuid, string $name, string $email, ?Carbon $emailVerifiedAt = null)
    {
        $this->id = $uuid;

        $this->name = $name;

        $this->email = $email;

        $this->emailVerifiedAt = $emailVerifiedAt;
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

    public function getKey(): string
    {
        return $this->id;
    }

    public function hasVerifiedEmail()
{
    return ! is_null($this->emailVerifiedAt);
}
}