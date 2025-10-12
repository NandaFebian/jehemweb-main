<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'phone_number' => '123',
            'name' => 'Super Admin',
            'password' => bcrypt('password*123'),
            'is_active' => true,
        ]);
        $admin = User::create([
            'phone_number' => '678',
            'name' => 'Super Admin',
            'password' => bcrypt('password*123'),
            'is_active' => true,
        ]);

        $user = User::create([
            'phone_number' => '345',
            'name' => 'User',
            'password' => bcrypt('password*123'),
            'is_active' => true,
        ]);

        $superadmin->assignRole(Role::SUPER_ADMIN->value);
        $admin->assignRole(Role::ADMIN->value);
        $user->assignRole(Role::USER->value);
    }
}
