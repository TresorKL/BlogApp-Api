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

    function getUserPost($id){

        $posts=Post::where('app_user_id','=',$id)->get();

        return response()->json([
            "status"=>true,
            "user_id"=>$id,
            "posts"=>$posts
        ]);
    }


    function postComment(Request $request){

        $post= Post::find($request->postId);

        $post->comment()->create([
            "commentBody"=>$request->commentBody
        ]);

        return response()->json([
            "status"=>true,
            "message"=>"Comment successfully posted"
        ]);
    }
}
