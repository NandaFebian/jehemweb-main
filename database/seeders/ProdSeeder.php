<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProdSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::role(Role::SUPER_ADMIN->value)->delete();
        $superadmin = User::create([
            'phone_number' => config('auth.super_admin.phone_number'),
            'name' => 'Super Admin',
            'password' => bcrypt(config('auth.super_admin.password')),
            'is_active' => true,
        ]);
        $superadmin->assignRole(Role::SUPER_ADMIN->value);
    }
}
