<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Laravel\Passport\Passport;

class CourseTest extends TestCase
{
    /**
     * Test get courses endpoint
     *
     * @return void
     */
    public function testCoursesSuccess()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['*']
        );
    
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get('api/courses');
        
        $response->assertStatus(200)
        ->assertJsonCount(15);
    }

    public function testCoursesFail()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->get('api/courses');
        $response->assertUnauthorized();
    }
}
