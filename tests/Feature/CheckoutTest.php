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
use App\Order;
use App\Payment;
use App\Shipping;

class CheckoutTest extends TestCase
{

    use RefreshDatabase;

    /** @test */

    public function order_is_added(){

        $this->withoutExceptionHandling();

        $order = Order::create([
            'customer_id' => 1,
            'shipping_id' => 1,
            'order_total' => 500
        ]);

        $this->assertCount(1, Order::all());


    }

    /** @test */
    public function payment_made_to_the_order_added(){

        $this->withoutExceptionHandling();

        $order = Order::create([
            'customer_id' => 1,
            'shipping_id' => 1,
            'order_total' => 500
        ]);

        $payment = Payment::create([
            'order_id'=>$order->order_id,
            'payment_type'=>'Cash',

        ]);

        $this->assertCount(1, Order::all());


    }

}