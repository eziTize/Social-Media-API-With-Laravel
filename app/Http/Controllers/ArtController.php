<?php

namespace App\Http\Controllers;

use App\Post;
use App\Connect;
use App\Http\Resources\Art as MomentResource;
use Illuminate\Http\Request;
use App\Http\Resources\ArtCollection;

class ArtController extends Controller
{


     public function index()
    {
        //return new ArtCollection(request()->user()->posts->where('type', 'Art'));

        $connects = Connect::connections();


        if ($connects->isEmpty()) {
            return new ArtCollection(request()->user()->posts->where('type', 'Art'));
        }

        return new ArtCollection(
            Post::where('type', 'Art')->whereIn('user_id', [$connects->pluck('user_id'), $connects->pluck('connect_id')])
                ->get()
        );
    }



     public function store()
    {
        $data = request()->validate([
            'data.attributes.body' => '',
        ]);

        $art = request()->user()->posts()->create($data['data']['attributes']);

        return new ArtResource($art);

    }
}
