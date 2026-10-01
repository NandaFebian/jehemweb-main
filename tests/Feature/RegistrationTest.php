<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Warung Jehem',
            'phone_number' => '081234567890',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ], $overrides);
    }

    public function test_registration_page_renders(): void
    {
        $this->get(route('register'))->assertOk()->assertSee('Registrasi');
        $this->get('/admin/register')->assertOk()->assertSee('Registrasi');
    }

    public function test_a_shop_owner_can_register_and_waits_for_activation(): void
    {
        $this->post(route('register.store'), $this->payload())
            ->assertRedirect(route('register'))
            ->assertSessionHas('registered');

        $user = User::where('phone_number', '081234567890')->sole();
        $this->assertFalse($user->is_active);
        $this->assertTrue($user->hasRole(Role::USER->value));
        $this->assertTrue(Hash::check('rahasia123', $user->password));
    }

    public function test_phone_numbers_must_be_unique_and_passwords_confirmed(): void
    {
        User::factory()->create(['phone_number' => '081234567890']);

        $this->post(route('register.store'), $this->payload(['password_confirmation' => 'beda']))
            ->assertSessionHasErrors(['phone_number', 'password']);

        $this->assertDatabaseCount('users', 1);
    }

    public function test_the_api_registration_endpoint_returns_json(): void
    {
        $this->postJson('/api/v1/auth/registration', $this->payload())
            ->assertCreated()
            ->assertJsonPath('data.phone_number', '081234567890')
            ->assertJsonMissingPath('data.password');

        $this->postJson('/api/v1/auth/registration', $this->payload())
            ->assertUnprocessable()
            ->assertJsonStructure(['status_code', 'message', 'errors' => ['phone_number']]);
    }
}
