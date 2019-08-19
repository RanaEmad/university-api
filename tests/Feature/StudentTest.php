<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    /**
     * Test create student endpoint
     *
     * @return void
     */
    public function testCreateStudentSuccess()
    {
        $response = $this->json('POST', 'api/students', ['name' => 'testCreateStudent',"email"=>"qweuhuinvefjbvjsbcvjavdfvcsd@create.com","password"=>"12345678"]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'result' => "success",
            ]);

        \DB::table("student")->where("email","qweuhuinvefjbvjsbcvjavdfvcsd@create.com")->delete();
    }


    /**
     * Test create student validation errors
     *
     * @return void
     */
    public function testCreateStudentValidationFail()
    {
        $response = $this->json('POST', 'api/students', ['name' => 'validation',"password"=>"12345678"]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'result' => "fail"
            ]);
    }

}
