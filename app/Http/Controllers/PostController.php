<?php

namespace App\Http\Controllers;

use App\Post;
use App\Connect;
use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Request;
use App\Http\Resources\PostCollection;

class PostController extends Controller
{


     public function index()
    {
        //return new PostCollection(request()->user()->posts->where('type', 'Post'));

         $connects = Connect::connections();

        if ($connects->isEmpty()) {
            return new PostCollection(request()->user()->posts->where('type', 'Post'));
        }

        return new PostCollection(
            Post::where('type', 'Post')->whereIn('user_id', [$connects->pluck('user_id'), $connects->pluck('connect_id')])
                ->get()
        );
    }



     public function store()
    {
        $data = request()->validate([
           // 'data.attributes.body' => '',
            'body' => 'required',
            'title' => 'required',
            'privacy' => '',
            'type' => 'required',
            'profanity' => ''
        ]);

       // $post = request()->user()->posts()->create($data['data']['attributes']);
        $post = request()->user()->posts()->create($data);

        return new PostResource($post);

    }
}
