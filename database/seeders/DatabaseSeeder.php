<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Roles are always required. Use `php artisan db:seed --class=DevSeeder` for local demo data
     * and `--class=ProdSeeder` to create the super admin from SUPER_ADMIN_* env values.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
    }
}
