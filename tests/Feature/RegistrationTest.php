<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_registration_page()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Register');
        $response->assertSee('Name');
        $response->assertSee('E-Mail Address');
        $response->assertSee('Password');
        $response->assertSee('Confirm Password');
    }

    public function test_auth_user_cannot_see_registration_page()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/register');
        $response->assertRedirect('/home');
    }

    public function test_registration_with_correct_data()
    {
        $response = $this->post('register', [
            'name' => 'JMac',
            'email' => 'jmac@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('home'));
    }

    public function test_user_with_not_correct_email_case()
    {
        $response = $this->post('register', [
            'name' => 'JMac',
            'email' => 'jm',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
    }

    public function test_user_with_not_correct_password_case()
    {
        $response = $this->post('register', [
            'name' => 'JMac',
            'email' => 'jm@mail.com',
            'password' => 'different pass',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
    }

    public function test_user_with_empty_data()
    {
        $response = $this->post('register', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(302);
    }

    public function test_user_with_different_names()
    {
        $response = $this->post('register', [
            'namee' => '',
            'emailewe' => '',
            'passweord' => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(302);
    }
}
