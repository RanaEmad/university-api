<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Laravel\Passport\Passport;

class RegistrationTest extends TestCase
{
    /**
     * Test register in course endpoint
     *
     * @return void
     */
    public function testRegistrationSuccess()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        
        $course= \DB::table("course")->first();

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('POST', 'api/registrations', ['course_id' => $course->id]);

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

}
