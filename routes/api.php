<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('create/account',[AuthController::class,'createUser']);
Route::post('login',[AuthController::class,'login']);
Route::get('users',[AuthController::class,'getUsers']);

Route::group(['middleware'=>'auth:sanctum'], function(){

    Route::post('post/blog',[BlogController::class,'postBlog']);
    Route::post('post/comment',[BlogController::class,'postComment']);
    Route::get('posts/{id}',[BlogController::class,'getUserPost']);

});

