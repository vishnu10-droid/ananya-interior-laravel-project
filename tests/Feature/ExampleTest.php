<?php

namespace Tests\Feature;

use App\Models\Enquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_loads(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('Ananya');
    }

    public function test_contact_page_loads(): void
    {
        $this->get('/contact')->assertStatus(200)->assertSee('Send Enquiry');
    }

    public function test_enquiry_is_saved_to_database(): void
    {
        $this->post('/contact/enquiry', [
            'name' => 'Test Customer',
            'phone' => '9876543210',
            'email' => 'test@example.com',
            'type' => 'Home Interior',
            'role' => 'Homeowner',
            'city' => 'Agra',
            'area' => 'Civil Lines',
            'pincode' => '282002',
            'requirements' => 'Immediate',
            'message' => 'Please contact me.',
        ])->assertRedirect('/contact');

        $this->assertDatabaseHas('enquiries', ['name' => 'Test Customer', 'status' => 'new']);
        $this->assertEquals(6, Enquiry::count());
    }

    public function test_admin_requires_authentication(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }
}
