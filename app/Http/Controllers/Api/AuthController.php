<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
           'name'=>'required|min:2|max:100',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:100',
            'confirm_password'=>'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'Validation error',
                'errors'=>$validator->errors()
            ], 422);
        }else{
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
            ]);

            return response()->json([
                'message'=> 'Registration successfull',
                'data'=>$user
            ], 200);
        }
    }



}
