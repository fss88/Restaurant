<?php

namespace Tests\Feature;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\Shipping;

class CustomersTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    // public function only_logged_in_customers_can_checkout()
    // {
    //     # code...

    //     $this->withoutExceptionHandling();

    //     $response = $this->get('/checkout-payment')
    //                         ->assertRedirect('/customer-login');


    // }

    /** @test */

    public function authenticated_customers_can_check_out(){

        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => Hash::make('secret1234'),
        ]);

        $this->actingAs($user);

        $response = $this->get('/checkout-payment')
                            ->assertOk();
    }

    /** @test */

    public function a_cutomer_can_be_added_through_a_form(){

        $this->withoutExceptionHandling();

        $response = $this->post('/save-customer', [
            'name' => 'Test_User',
            'email' => 'testuser@gmail.com',
            'phone_no' => '025588555',
            'password' => Hash::make('12345678')
        ]);

        $this->assertCount(1, Customer::all());

    }

    public function a_customer_shipping_adress_is_required_before_confirming_order(){

        $user = Customer::create([
            'name' => 'Test_User',
            'email' => 'testuser@gmail.com',
            'phone_no' => '025588555',
            'password' => Hash::make('12345678')
        ]);

        $this->actingAs($user);

        $response = $this->post('/save-shipping', [
            'name' =>$user->name,
            'email' =>$user->email,
            'phone_no' =>$user->phone_no,
            'address' =>'520, Nk',
        ]);

        $this->assertCount(1, Shipping::all());
    }
}
