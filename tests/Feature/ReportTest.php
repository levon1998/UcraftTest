<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_main_wallet_page_for_auth_with_wallet()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/report');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_main_wallet_page_for_auth_without_wallet()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/report');

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_can_see_report_table_columns()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/report');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);

        $response->assertSuccessful();
        $response->assertViewIs('userPages.reports.index');
        $response->assertSee('Id');
        $response->assertSee('Wallet');
        $response->assertSee('Type');
        $response->assertSee('Amount');
        $response->assertSee('Created Date');
        $response->assertSee('Select Wallet');
        $response->assertSee('Search');
    }
}
