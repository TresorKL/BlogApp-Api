<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\AppUser;

class BlogController extends Controller
{
    //
    function postBlog(Request $request){

        $user = AppUser::find($request->id);

        $user->post()->create([
           "title"=>$request->title,
           "body"=>$request->body
        ]);


        return response()->json([
            "status"=>true,
            "message"=>"Blog successfully posted"
        ]);


    }
}
