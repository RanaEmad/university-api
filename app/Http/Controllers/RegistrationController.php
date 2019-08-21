<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
            'course_id' => 'required'
        ]);

        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            $response['errors']=$errors;
        }
        else{

            $student= $request->user();

            //make sure course is available for registration
            $course=\App\Course::available($request->input("course_id"))->first();
            
            if($course){
                //make sure student is not already enrolled
                $enrolled= Registration::where("student_id",$student->id)->where("course_id",$request->input("course_id"))->first();
                if(!$enrolled){
                    $registration= new Registration;
                    $registration->student_id= $student->id;
                    $registration->course_id= $request->input("course_id");
                    $registration->registered_on= date("Y-m-d H:i:s");
                    $registration->save();
                    $status_code=201;
                    $response['result']="success";
                }
                else{
                    $status_code=409;
                    $response['error']="You are already enrolled in this course";
                }
            }
            else{
                $response['error']="Course doesn't exist or is unavailable";
            }
        }

       return response()->json($response,$status_code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
