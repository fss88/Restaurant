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
class OrdersTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function only_logged_in_users_can_manage_orders()
    {
        # code...

        $this->withoutExceptionHandling();

        $response = $this->get('/manage-order')
                            ->assertRedirect('/login');

    }

    /** @test */


}
