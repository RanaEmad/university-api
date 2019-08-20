<?php

use Illuminate\Database\Seeder;

class RegistrationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Registration::create(['student_id'=>1,'course_id' => 1,'registered_on'=>date("Y-m-d H:i:s") ]);
    }
}
