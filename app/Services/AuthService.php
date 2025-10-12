<?php

namespace App\Services;

use App\Enums\Role;
use App\Exceptions\UserPhoneExistException;
use App\Models\User;

class AuthService
{
    public function __construct(protected User $model)
    {
    }

    public function register(array $data = []): User
    {
        $checkPhoneNumber = User::query()
            ->where('phone_number', $data['phone_number'])
            ->where('is_active', true)
            ->first();

        if ($checkPhoneNumber) {
            throw new UserPhoneExistException();
        }

        $user = User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'is_active' => false,
            'password' => bcrypt($data['password']),
        ]);
        $user->assignRole(Role::USER->value);

        return $user;
    }
}
