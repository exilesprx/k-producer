<?php

namespace App\Repositories;

use App\Entities\UnverifiedUser;
use App\User;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserRepository
{
    public function createNewUser(string $name, string $email, string $password): UnverifiedUser
    {
        $uuid = Uuid::uuid4();

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'uuid' => $uuid
        ]);

        return new UnverifiedUser($user->id, $uuid, $name, $email);
    }
}