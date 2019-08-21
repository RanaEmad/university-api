<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses= Course::withAvailibility()->get();
        $response["result"]="success";
        $response["courses"]=$courses;

        return response()->json($response,200);
    }

}
