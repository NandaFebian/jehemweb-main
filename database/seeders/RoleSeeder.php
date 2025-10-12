<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Role as EnumsRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::findOrCreate(EnumsRole::ADMIN->value);
        Role::findOrCreate(EnumsRole::SUPER_ADMIN->value);
        Role::findOrCreate(EnumsRole::USER->value);
    }
}
