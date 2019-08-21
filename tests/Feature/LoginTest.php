<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * Test a successful login
     *
     * @return void
     */
    public function testLoginSuccess()
    {
        $response = $this->json('POST', 'api/login', ["email"=>"test@email.com","password"=>"12345678"]);
        
        $response->assertStatus(200)->assertJsonStructure([
            "result",
            "accessToken"
        ]);
    }

    /**
     * Test a failed login
     *
     * @return void
     */
    public function testLoginFail()
    {
        $response = $this->json('POST', 'api/login', ["email"=>"test@email.com","password"=>"123"]);

        $response->assertStatus(400)->assertJsonStructure([
            "result",
            "error"
        ]);
    }
}
