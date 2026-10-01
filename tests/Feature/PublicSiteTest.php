<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Visitor;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleSeeder::class);
    }

    public function test_home_page_lists_only_published_products(): void
    {
        $published = Product::factory()->approved()->create(['name' => 'Tenun Jehem']);
        $unapproved = Product::factory()->create(['name' => 'Belum Disetujui']);
        $inactive = Product::factory()->approved()->create(['name' => 'Tidak Aktif', 'is_active' => false]);

        $this->get('/')
            ->assertOk()
            ->assertSee($published->name)
            ->assertDontSee($unapproved->name)
            ->assertDontSee($inactive->name);
    }

    public function test_home_page_counts_one_visit_per_request(): void
    {
        $this->get('/')->assertOk();
        $this->get('/')->assertOk();

        $this->assertSame(2, Visitor::sole()->count);
    }

    public function test_home_page_can_search_and_filter_by_category(): void
    {
        $category = Category::create(['name' => 'Kerajinan']);
        $basket = Product::factory()->approved()->create(['name' => 'Keranjang Bambu']);
        $basket->categories()->attach($category);
        Product::factory()->approved()->create(['name' => 'Kopi Bangli']);

        // The footer and trending carousel list every product, so assert on the filtered listing itself.
        $listed = fn (string $url) => $this->get($url)->assertOk()->viewData('products')->pluck('name')->all();

        $this->assertSame(['Keranjang Bambu'], $listed('/?query=bambu'));
        $this->assertSame(['Keranjang Bambu'], $listed('/?category='.$category->id));
        $this->assertSame([], $listed('/?query=kopi&category='.$category->id));
        $this->assertCount(2, $listed('/'));
    }

    public function test_about_and_contact_pages_render(): void
    {
        Comment::factory()->create(['message' => 'Produknya bagus sekali']);

        $this->get('/about')->assertOk()->assertSee('Tentang Kami')->assertSee('Produknya bagus sekali');
        $this->get('/contact')->assertOk()->assertSee('Kontak kami');
    }

    public function test_product_page_shows_details_and_counts_the_visit(): void
    {
        $product = Product::factory()->approved()->create(['visitor_count' => 10]);
        Comment::factory()->for($product)->create(['rating' => 4, 'message' => 'Mantap']);
        Comment::factory()->for($product)->create(['rating' => 5]);

        $this->get(route('products.show', $product->id))
            ->assertOk()
            ->assertSee($product->name)
            ->assertSee('Mantap')
            ->assertSee('4.5');

        $this->assertSame(11, $product->fresh()->visitor_count);
    }

    public function test_unpublished_or_missing_products_return_404(): void
    {
        $product = Product::factory()->create();

        $this->get(route('products.show', $product->id))->assertNotFound();
        $this->get('/detail-product/999')->assertNotFound();
    }
}
