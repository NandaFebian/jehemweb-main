<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class ProdSeeder extends Seeder
{
    /**
     * Create (or reset) the super admin from the SUPER_ADMIN_PHONE / SUPER_ADMIN_PASSWORD env values.
     */
    public function run(): void
    {
        $phone = config('auth.super_admin.phone_number');
        $password = config('auth.super_admin.password');

        if (blank($phone) || blank($password)) {
            throw new RuntimeException('Set SUPER_ADMIN_PHONE and SUPER_ADMIN_PASSWORD in .env before running ProdSeeder.');
        }

        $this->call(RoleSeeder::class);

        User::role(Role::SUPER_ADMIN->value)->where('phone_number', '!=', $phone)->delete();

        $superadmin = User::updateOrCreate(
            ['phone_number' => $phone],
            ['name' => 'Super Admin', 'password' => Hash::make($password), 'is_active' => true],
        );
        $superadmin->syncRoles([Role::SUPER_ADMIN->value]);
    }
}
