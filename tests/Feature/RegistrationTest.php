<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Student;
use Laravel\Passport\Passport;

class RegistrationTest extends TestCase
{
    /**
     * Test successful registration in course endpoint
     *
     * @return void
     */
    public function testRegistrationSuccess()
    {
        \DB::beginTransaction();

        Passport::actingAs(
            factory(Student::class)->create(),
            ['*']
        );

        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('POST', 'api/registrations', ['course_id' => 2]);

        \DB::rollBack();
        $response->assertStatus(201);
    }

    /**
     * Test validation failure in course registration endpoint
     *
     * @return void
     */
    public function testRegistrationValidationFail()
    {
        Passport::actingAs(
            factory(Student::class)->create(),
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

    /**
     * Test failed authentication in registration endpoint
     *
     * @return void
     */
    public function testRegistrationAuthFail()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->json('POST', 'api/registrations', ['course_id' => 1]);
        $response->assertUnauthorized();
    }

    /**
     * Test unavailable course in registration endpoint
     *
     * @return void
     */
    public function testCourseUnavailable()
    {
        Passport::actingAs(
            factory(Student::class)->create(),
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
