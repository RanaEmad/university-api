<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response['result']="fail";
        $status_code=400;

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|string|email|unique:student|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            $response['error']=$errors;
        }
        else{
            $student= new Student;
            $student->name=$request->input("name");
            $student->email=$request->input("email");
            $student->password=Hash::make($request->input("password"));
            $student->save();
            $status_code=201;
            $response['result']="success";
            $response['student_id']=$student->id;
        }

       return response()->json($response,$status_code);
    }
    
}
