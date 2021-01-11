<?php

namespace App\Http\Controllers;

use App\Post;
use App\Connect;
use App\Http\Resources\Moment as MomentResource;
use Illuminate\Http\Request;
use App\Http\Resources\MomentCollection;

class MomentController extends Controller
{


     public function index()
    {
        //return new MomentCollection(request()->user()->posts->where('type', 'Moment'));

        $connects = Connect::connections();

        if ($connects->isEmpty()) {
            return new MomentCollection(request()->user()->posts->where('type', 'Moment'));
        }

        return new MomentCollection(
            Post::where('type', 'Moment')->whereIn('user_id', [$connects->pluck('user_id'), $connects->pluck('connect_id')])
                ->get()
        );

    }


     public function store()
    {
        $data = request()->validate([
            'data.attributes.body' => '',
        ]);

        $moment = request()->user()->posts()->create($data['data']['attributes']);

        return new MomentResource($moment);

    }
}
