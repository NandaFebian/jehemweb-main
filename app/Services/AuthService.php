<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Register a shop owner. The account stays inactive until an admin activates it.
     *
     * @param  array{name: string, phone_number: string, password: string}  $data
     */
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'is_active' => false,
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole(Role::USER->value);

        return $user;
    }
}
