<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Ramsey\Uuid\UuidInterface;

class UnverifiedUser extends User implements MustVerifyEmailContract
{
    use MustVerifyEmail;

    private $emailVerifiedAt;

    private $recordId;

    public function __construct(int $recordId, UuidInterface $uuid, string $name, string $email, ?Carbon $emailVerifiedAt = null)
    {
        parent::__construct($uuid, $name, $email);

        $this->recordId = $recordId;

        $this->emailVerifiedAt = $emailVerifiedAt;
    }

    public function getKey(): string
    {
        return $this->recordId;
    }

    public function hasVerifiedEmail()
    {
        return ! is_null($this->emailVerifiedAt);
    }
}