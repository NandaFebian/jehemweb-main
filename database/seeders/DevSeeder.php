<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Local development data. Every account uses the password "password*123".
 *   - 123 : super admin
 *   - 678 : admin
 *   - 345 : shop owner (user)
 */
class DevSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $accounts = [
            ['phone_number' => '123', 'name' => 'Super Admin', 'role' => Role::SUPER_ADMIN],
            ['phone_number' => '678', 'name' => 'Admin', 'role' => Role::ADMIN],
            ['phone_number' => '345', 'name' => 'User', 'role' => Role::USER],
        ];

        foreach ($accounts as $account) {
            $user = User::firstOrCreate(
                ['phone_number' => $account['phone_number']],
                ['name' => $account['name'], 'password' => Hash::make('password*123'), 'is_active' => true],
            );
            $user->syncRoles([$account['role']->value]);
        }

        if (Product::query()->exists()) {
            return;
        }

        $categories = collect(['Kerajinan', 'Peternakan', 'Pertanian', 'Jasa'])
            ->map(fn (string $name) => Category::create(['name' => $name]));

        Product::factory()
            ->count(8)
            ->approved()
            ->create()
            ->each(function (Product $product) use ($categories) {
                $product->categories()->attach($categories->random());
                $product->user->assignRole(Role::USER->value);
                Comment::factory()->count(2)->for($product)->create();
            });
    }
}
