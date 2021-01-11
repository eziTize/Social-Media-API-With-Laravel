<?php

namespace App\Http\Controllers;

use App\Http\Resources\Vote as VoteResource;
use App\Http\Resources\VoteCollection;
use Illuminate\Http\Request;
use App\Post;
use App\Vote;
use Auth;

class PostVoteController extends Controller
{
    public function store(Post $post)
    {
        $post->votes()->toggle(auth()->user());

        return new VoteCollection($post->votes);
    }


    /*-- Post Rating Store --*/

	/*public function store(Request $request, $id)
	{

		if(Vote::where('user_id', auth()->user()->id)->where('post_id', $id)->count() > 0){

            $data = Vote::where('user_id', auth()->user()->id)->where('post_id', $id)->firstOrFail();
            $data->star = $request->input('star');
            $data->save();

            return new VoteResource($data);

        }

            $data = new Vote;
            $data->user_id = auth()->user()->id;
            $data->post_id = $id;
            $data->star = $request->input('star');
            $data->save();

            return new VoteResource($data);

	}


    public function update(Request $request, $id)
    {

            $data = Vote::where('user_id', auth()->user()->id)->where('post_id', $id)->firstOrFail();
            $data->star = $request->input('star');
            $data->save();

            return new VoteResource($data);
    }*/

	/*public function VoteCount($id)
	{

		$count = Vote::where('post_id', $id)->count();

        return response()->json(['count' => $count]);

	}*/

	public function delete($id)
	{

		Vote::where('user_id', 1)->where('post_id', $id)->delete();

        return response()->json(['status'=>'Deleted']);

	}
}