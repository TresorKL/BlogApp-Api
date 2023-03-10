<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AppUser;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;

class AuthController extends Controller
{
    function createUser(Request $request){

          // create user for auth
          $user=User::create([
            'name'=>$request->firstName,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $user->appUser()->create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'email'=>$request->email, 
        ]);


        return response()->json([
            "status"=>true,
            "message"=>"Account successfully created",
            "accessToken"=>$user->createToken("API TOKEN")->plainTextToken
            
      ],200);
      
    }

    function login(Request $request){

        if(!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                "status"=>false,
                "message"=>"invalid credentials",
               
             ],401);
         }
        
         $appUser =AppUser::where('email', $request->email)->get();

         $user =User::where('email', $request->email)->first();
         return response()->json([
            "status"=>true,
            "message"=>"Logged successfully",
            "user"=>$appUser,
            "token"=>$user->createToken("API TOKEN")->plainTextToken
      ],200);
    }


    function getUsers(){

        return response()->json([
            "status"=>true,
            "data"=>AppUser::all()
        ]);
    }
}
