<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data):User
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);
    }
    public function login(array $data): bool
    {

    }
}
