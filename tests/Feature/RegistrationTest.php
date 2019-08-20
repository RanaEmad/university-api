<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Laravel\Passport\Passport;

class RegistrationTest extends TestCase
{
    // use RefreshDatabase;
    // use DatabaseTransactions;
    /**
     * Test register in course endpoint
     *
     * @return void
     */
    public function testRegistrationSuccess()
    {
        \DB::beginTransaction();

        Passport::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('POST', 'api/registrations', ['course_id' => 2]);

        \DB::rollBack();
        $response->assertStatus(201);
    }

    public function testRegistrationValidationFail()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('POST', 'api/registrations', []);

        // $response->dump();
        $response->assertStatus(400)
        ->assertJsonStructure([
            "result",
            "errors"
        ]);
    }

    public function testRegistrationAuthFail()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('POST', 'api/registrations', ['course_id' => 1]);
        $response->assertUnauthorized();
    }

    public function testCourseUnavailable()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['*']
        );

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('POST', 'api/registrations', ["course_id"=>1]);

        $response->assertStatus(400)
        ->assertJsonStructure([
            "result",
            "error"
        ]);
    }

}
