<?php

namespace App\Repositories;

use App\Entities\User as UserEntity;
use App\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserRepository
{
    public function createNewUser(string $name, string $email, string $password): UserEntity
    {
        $uuid = Uuid::uuid4();

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'uuid' => $uuid
        ]);

        return new UserEntity($uuid, $name, $email);
    }
}