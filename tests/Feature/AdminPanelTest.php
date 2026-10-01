<?php

namespace Tests\Feature;

use App\Enums\Role;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Widgets\ProductCountOverview;
use App\Filament\Resources\ProductResource\Widgets\VisitorOverview;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    private function userWithRole(Role $role, array $attributes = []): User
    {
        return tap(User::factory()->create($attributes))->assignRole($role->value);
    }

    public function test_guests_are_redirected_to_the_login_page(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/login')->assertOk();
    }

    public function test_every_role_can_open_the_dashboard_and_their_pages(): void
    {
        foreach ([Role::SUPER_ADMIN, Role::ADMIN, Role::USER] as $role) {
            $user = $this->userWithRole($role);

            $this->actingAs($user)->get('/admin')->assertOk();
            $this->actingAs($user)->get('/admin/products')->assertOk();
            $this->actingAs($user)->get('/admin/users')->assertOk();
        }
    }

    public function test_only_admins_can_manage_categories(): void
    {
        $this->actingAs($this->userWithRole(Role::ADMIN))->get('/admin/categories')->assertOk();
        $this->actingAs($this->userWithRole(Role::USER))->get('/admin/categories')->assertForbidden();
    }

    public function test_shop_owners_only_see_their_own_products(): void
    {
        $owner = $this->userWithRole(Role::USER);
        $own = Product::factory()->for($owner)->create();
        $other = Product::factory()->create();

        $this->actingAs($owner);
        Livewire::test(ListProducts::class)
            ->assertCanSeeTableRecords([$own])
            ->assertCanNotSeeTableRecords([$other]);

        $this->get("/admin/products/{$other->id}/edit")->assertForbidden();
    }

    public function test_shop_owners_need_an_active_account_and_may_own_one_product(): void
    {
        $owner = $this->userWithRole(Role::USER);
        $this->actingAs($owner)->get('/admin/products/create')->assertOk();

        Product::factory()->for($owner)->create();
        $this->actingAs($owner)->get('/admin/products/create')->assertForbidden();

        $inactive = $this->userWithRole(Role::USER, ['is_active' => false]);
        $this->actingAs($inactive)->get('/admin/products/create')->assertForbidden();

        $this->actingAs($this->userWithRole(Role::ADMIN))->get('/admin/products/create')->assertOk();
    }

    public function test_super_admin_can_change_a_users_role(): void
    {
        $member = $this->userWithRole(Role::USER);
        $this->actingAs($this->userWithRole(Role::SUPER_ADMIN));

        Livewire::test(EditUser::class, ['record' => $member->getRouteKey()])
            ->fillForm(['role' => Role::ADMIN->value])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertTrue($member->fresh()->hasRole(Role::ADMIN->value));
        $this->assertFalse($member->fresh()->hasRole(Role::USER->value));
    }

    public function test_dashboard_widgets_count_the_owners_products(): void
    {
        $owner = $this->userWithRole(Role::USER);
        Product::factory()->for($owner)->create(['visitor_count' => 7]);
        Product::factory()->create(['visitor_count' => 100]);

        $this->actingAs($owner)->get('/admin')->assertOk()->assertSeeLivewire(VisitorOverview::class);

        $statValue = fn (string $widget) => (fn () => $this->getStats()[0]->getValue())->call(new $widget());

        $this->assertEquals(7, $statValue(VisitorOverview::class));
        $this->assertEquals(1, $statValue(ProductCountOverview::class));

        $this->actingAs($this->userWithRole(Role::ADMIN));
        $this->assertEquals(2, $statValue(ProductCountOverview::class));
    }
}
