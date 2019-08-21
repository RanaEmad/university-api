<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    /**
     * Test create student endpoint with success
     *
     * @return void
     */
    public function testCreateStudentSuccess()
    {
        \DB::beginTransaction();

        $response = $this->json('POST', 'api/students', ['name' => 'testCreateStudent',"email"=>"qweuhuinvefjbvjsbcvjavdfvcsd@create.com","password"=>"12345678"]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'result' => "success",
            ]);

        \DB::rollBack();

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
