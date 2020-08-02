<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/password/reset');

        $response->assertStatus(200);
        $response->assertSee('Reset Password');
        $response->assertSee('E-Mail Address');
        $response->assertSee('Send Password Reset Link');
    }
}
