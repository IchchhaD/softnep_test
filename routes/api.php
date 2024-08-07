
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register']);

Route::group(['middleware' => 'api'], function()
{
    Route::post('/login', [LoginController::class, 'login']);
});


    Route::get('/getPosts', [PostsController::class, 'getPosts']);
    Route::post('/createPosts', [PostsController::class, 'createPosts']);
    Route::put('/updatePosts/{id}', [PostsController::class, 'updatePosts']);
    Route::post('/deletePosts', [PostsController::class, 'deletePosts']);

    Route::get('/getComments/{post_id}', [CommentsController::class, 'getComments']);
    Route::post('/createComments', [CommentsController::class, 'createComments']);
    Route::put('/updateComments/{id}/{post_id}', [CommentsController::class, 'updateComments']);
    Route::post('/deleteComments', [CommentsController::class, 'deleteComments']);