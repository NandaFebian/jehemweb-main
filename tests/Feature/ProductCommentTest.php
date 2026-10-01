<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCommentTest extends TestCase
{
    use RefreshDatabase;

    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
        $this->product = Product::factory()->approved()->create();
    }

    public function test_guests_are_sent_to_the_login_page(): void
    {
        $this->post(route('products.comments.store', $this->product->id), ['rating' => 5, 'message' => 'Halo'])
            ->assertRedirect(route('filament.admin.auth.login'));

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_a_user_can_review_a_product_once(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('products.comments.store', $this->product->id), ['rating' => 4, 'message' => 'Bagus'])
            ->assertRedirect()
            ->assertSessionHas('status');

        $this->assertDatabaseHas('comments', [
            'product_id' => $this->product->id,
            'user_id' => $user->id,
            'rating' => 4,
            'message' => 'Bagus',
        ]);

        $this->actingAs($user)
            ->post(route('products.comments.store', $this->product->id), ['rating' => 1, 'message' => 'Lagi'])
            ->assertSessionHasErrors('message');

        $this->assertDatabaseCount('comments', 1);
        $this->get(route('products.show', $this->product->id))->assertDontSee('Tuliskan komentar anda');
    }

    public function test_review_input_is_validated(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('products.comments.store', $this->product->id), ['rating' => 9, 'message' => ''])
            ->assertSessionHasErrors(['rating', 'message']);

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_unpublished_products_cannot_be_reviewed(): void
    {
        $hidden = Product::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('products.comments.store', $hidden->id), ['rating' => 5, 'message' => 'Halo'])
            ->assertNotFound();
    }
}
