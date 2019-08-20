<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';

    public function scopeWithAvailibility($query)
    {
        return $query->select('course.*',
         \DB::raw('(Case WHEN COUNT(registration.student_id) < course.capacity THEN "Yes" ELSE "No" END ) as available'))
        ->leftJoin('registration', 'course.id', '=', 'registration.course_id')
        ->groupBy("course.id");
    }

    public function scopeAvailable($query,$course_id)
    {
        return  $query->select('course.*', \DB::raw('COUNT(registration.student_id) as available') )
                ->where("course.id",$course_id)
                ->leftJoin('registration', 'course.id', '=', 'registration.course_id')
                ->groupBy("course.id")
                ->havingRaw("COUNT(registration.student_id) < course.capacity ");
    }
}
