<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserIndexPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_index_page_with_auth_user_and_with_wallet()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_index_page_with_auth_user_and_without_wallet()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_not_auth_user_access_to_page()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }
}
