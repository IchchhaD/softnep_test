
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

Route::post('/register', 'UserController@register');

Route::group(['middleware' => 'api'], function()
{
    Route::post('/login', 'LoginController@login');
});

Route::middleware(['auth:api'])->prefix('v1')->group(function ()
{
    Route::get('/getPosts', 'PostsController@getPosts');
    Route::post('/createPosts', 'PostsController@createPosts');
    Route::put('/updatePosts/{id}', 'PostsController@updatePosts');
    Route::post('/deletePosts', 'PostsController@deletePosts');

    Route::get('/getComments/{post_id}', 'PostsController@getComments');
    Route::post('/createComments', 'PostsController@createComments');
    Route::put('/updateComments/{id}/{post_id}', 'PostsController@updateComments');
    Route::post('/deleteComments', 'PostsController@deleteComments');
});