<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
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
        $response = $this->actingAs($user)->get('/wallets');

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
        $response = $this->actingAs($user)->get('/wallets');

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_can_see_wallet_table_columns()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/wallets');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);

        $response->assertSuccessful();
        $response->assertViewIs('userPages.wallets.index');
        $response->assertSee('Id');
        $response->assertSee('Name');
        $response->assertSee('Type');
        $response->assertSee('Total Amount');
        $response->assertSee('Actions');
    }

    public function test_auth_user_can_see_total_of_all_wallets()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/wallets');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);

        $response->assertSuccessful();
        $response->assertViewIs('userPages.wallets.index');
        $response->assertSee('Total of All wallets is');
    }

    public function test_auth_user_with_wallet_can_see_add_wallet_page()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/add-wallet');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
        $response->assertSuccessful();
        $response->assertViewIs('userPages.wallets.createOrEdit');
        $response->assertSee('Please choose the type of wallet:');
        $response->assertSee('Credit Card');
        $response->assertSee('Cash');
        $response->assertSee('Save And Continue');
    }

    public function test_auth_user_without_wallet_cannot_see_add_wallet_page()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/add-wallet');

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_to_store_new_wallet_with_correct_data()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/store-wallet', [
            'type' => 1,
            'user_id' => $user->id,
            'name' => 'Wallet 1',
        ]);

        $response->assertRedirect('/wallets');
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_to_store_new_wallet_without_data()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/store-wallet', [
            'type' => '',
            'name' => '',
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_to_see_back_button_on_create_and_edit_pages()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/add-wallet');

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
        $response->assertSuccessful();
        $response->assertViewIs('userPages.wallets.createOrEdit');
        $response->assertSee('Back');
    }

    public function test_auth_user_with_wallet_can_see_edit_wallet_page()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/wallet/'.$user->wallets->first()->id);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
        $response->assertSuccessful();
        $response->assertViewIs('userPages.wallets.createOrEdit');
        $response->assertSee('Please choose the type of wallet:');
        $response->assertSee('Credit Card');
        $response->assertSee('Cash');
        $response->assertSee('Save And Continue');
    }

    public function test_auth_user_with_wallet_can_see_edit_of_not_existing_wallet_page()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/wallet/99');

        $response->assertStatus(404);
        $this->assertAuthenticatedAs($user);
    }


    public function test_auth_user_with_wallet_can_see_edit_of_string_given_id_wallet_page()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/wallet/dfwefwef');

        $response->assertStatus(404);
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_to_update_wallet_with_correct_data()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/store-wallet', [
            'id' => 1,
            'type' => 1,
            'name' => 'Wallet 2',
        ]);

        $response->assertRedirect('/wallets');
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_to_update_wallet_with_not_correct_data()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/store-wallet', [
            'id' => 1,
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_can_remove_his_own_wallets_with_correct_id()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/wallet/delete', [
            'id' => $user->wallets->first()->id
        ]);

        $response->assertStatus(200);
        $this->assertAuthenticatedAs($user);
    }

    public function test_auth_user_can_remove_his_own_wallets_with_not_correct_id()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post('/wallet/delete', [
            'id' => 998514
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
}
