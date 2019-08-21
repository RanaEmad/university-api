<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Logs student in.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $response['result']="fail";
        $status_code=400;

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails())
        {
            $errors = $validator->errors()->all();
            $response['error']=$errors;
        }
        else{
            $student= User::where("email",$request->input("email"))->first();
            if($student && Hash::check($request->input("password"),$student->password)){
                $token = $student->createToken("Laravel Password Grant Client")->accessToken;
                $status_code=200;
                $response['result']="success";
                $response['accessToken']=$token;
            }
            else
            {
                $response['error']="Invalid Credentials";
            }
        }

       return response()->json($response,$status_code);
    }
}
