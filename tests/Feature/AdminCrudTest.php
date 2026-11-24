<?php

namespace Tests\Feature;

use App\Livewire\Admin\CategoryManager;
use App\Livewire\Admin\ProductManager;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_create_edit_and_delete_a_product_from_the_panel(): void
    {
        $admin = User::where('email', 'admin@ananyaagra.com')->firstOrFail();
        $category = Category::firstOrFail();

        Livewire::actingAs($admin)->test(ProductManager::class)
            ->set('name', 'CRUD Verification Product')
            ->set('category_id', $category->id)
            ->call('save')
            ->assertHasNoErrors();

        $product = Product::where('slug', 'crud-verification-product')->firstOrFail();
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'CRUD Verification Product']);

        $this->get('/products?q=CRUD%20Verification')
            ->assertStatus(200)
            ->assertSee('CRUD Verification Product');

        Livewire::actingAs($admin)->test(ProductManager::class)
            ->call('edit', $product->id)
            ->set('short_description', 'Updated from the admin panel')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('Updated from the admin panel', $product->fresh()->short_description);

        Livewire::actingAs($admin)->test(ProductManager::class)
            ->call('delete', $product->id);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_new_category_shows_on_the_public_site_and_delete_removes_it(): void
    {
        $admin = User::where('email', 'admin@ananyaagra.com')->firstOrFail();

        Livewire::actingAs($admin)->test(CategoryManager::class)
            ->set('name', 'CRUD Verification Category')
            ->set('group', 'Boards & Laminates')
            ->call('save')
            ->assertHasNoErrors();

        $category = Category::where('slug', 'crud-verification-category')->firstOrFail();
        $this->get('/')->assertSee('CRUD Verification Category');

        Livewire::actingAs($admin)->test(CategoryManager::class)
            ->call('delete', $category->id);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
        $this->get('/')->assertDontSee('CRUD Verification Category');
    }

    public function test_corporate_office_and_google_map_are_shown(): void
    {
        $this->get('/contact')
            ->assertStatus(200)
            ->assertSee('Ananya Endless Decor')
            ->assertSee('Mangal Sen Bhawan, 21/18, Freeganj Rd, Belanganj, Civil Lines, Agra, Uttar Pradesh 282003')
            ->assertSee('Mangal+Sen+Bhawan')
            ->assertSee('output=embed');

        $this->get('/about')
            ->assertStatus(200)
            ->assertSee('Mangal Sen Bhawan, 21/18, Freeganj Rd, Belanganj, Civil Lines, Agra, Uttar Pradesh 282003')
            ->assertSee('output=embed');
    }

    public function test_both_contact_numbers_are_shown_from_settings(): void
    {
        $this->get('/contact')
            ->assertStatus(200)
            ->assertSee('7351400063')
            ->assertSee('90847 27055')
            ->assertSee('tel:+919084727055');

        $this->get('/')
            ->assertStatus(200)
            ->assertSee('7351400063')
            ->assertSee('90847 27055');
    }

    public function test_admin_can_change_the_two_application_cards_on_a_category_page(): void
    {
        $admin = User::where('email', 'admin@ananyaagra.com')->firstOrFail();
        $category = Category::where('slug', 'plywood')->firstOrFail();

        Livewire::actingAs($admin)->test(CategoryManager::class)
            ->call('edit', $category->id)
            ->set('look_one_caption', 'My custom plywood look')
            ->set('look_one_image', '/images/company-profile/page-23-image-01.png')
            ->set('look_two_caption', 'Second custom look')
            ->set('look_two_image', '/images/company-profile/page-22-image-01.png')
            ->call('save')
            ->assertHasNoErrors();

        $this->get('/products/plywood')
            ->assertStatus(200)
            ->assertSee('In Real Spaces')
            ->assertSee('My custom plywood look')
            ->assertSee('Second custom look');
    }
}
