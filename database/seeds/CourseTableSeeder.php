<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registration')->truncate();
        DB::table('course')->truncate();

        App\Course::create(['name'=>"course",'capacity' => 1 ]);
        factory(App\Course::class, 14)->create();
    }
}
