<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('registration')->truncate();
        DB::table('student')->truncate();

        App\Student::create(['name'=>"Test Student",'email' => 'test@email.com','password'=>'$2y$10$D2ugR4HZRClXe6sa6obo0ORAI3MHfbLoxp.Rz6l56Y/lx/8Ut8LF.']);
    }
}
