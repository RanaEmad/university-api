<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Student;
use Laravel\Passport\Passport;

class CourseTest extends TestCase
{
    /**
     * Test get courses endpoint with success
     *
     * @return void
     */
    public function testCoursesSuccess()
    {
        Passport::actingAs(
            factory(Student::class)->create(),
            ['*']
        );
    
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get('api/courses');
        
        $response->assertStatus(200)
        ->assertJsonStructure([
            "result",
            "courses"
        ])
        ->assertJsonCount(15,"courses");
    }

    /**
     * Test get courses endpoint with failure
     *
     * @return void
     */
    public function testCoursesFail()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get('api/courses');
        $response->assertUnauthorized();
    }
}
