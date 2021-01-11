<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post as PostResource;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function index(User $user)
    {
        //$data = Post::where('user_id', $user->id)->where('type', 'Post')->get();
        return PostResource::collection($user->posts->where('type', 'Post'));
        
    }
}