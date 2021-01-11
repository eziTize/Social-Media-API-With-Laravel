<?php

//use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/

Route::middleware('auth:api')->group(function () {
   Route::get('auth-user', 'AuthUserController@show');
   Route::apiResources([
       'posts' => 'PostController',
       '/posts/{post}/vote' => 'PostVoteController',
       '/posts/{post}/comment' => 'PostCommentController',
       'moments' => 'MomentController',
       'arts' => 'ArtController',
       'users' => 'UserController',
       '/users/{user}/posts' => 'UserPostController',
       '/users/{user}/moments' => 'UserMomentController',
       '/users/{user}/arts' => 'UserArtController',
       '/connect-request' => 'ConnectRequestController',
       '/connect-request-response' => 'ConnectRequestResponseController',
       '/user-images' => 'UserImageController',
   ]);

 // Route::get('posts/{id}/vote-count', 'PostVoteController@VoteCount');
   Route::delete('post/{id}/vote/delete', 'PostVoteController@delete');

});