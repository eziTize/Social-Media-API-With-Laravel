<?php

namespace App\Http\Controllers;

use App\Exceptions\ConnectRequestNotFoundException;
use App\Connect;
use App\Http\Resources\Connect as ConnectResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ConnectRequestResponseController extends Controller
{

    /* Accept/Store Connect Requests */
    public function store()
    {
        $data = request()->validate([
            'user_id' => 'required',
            'status' => 'required',
        ]);

        try {
            $connectRequest = Connect::where('user_id', $data['user_id'])
                              ->where('connect_id', auth()->user()->id)
                              ->firstOrFail();

            } catch  (ModelNotFoundException $e) {
            throw new ConnectRequestNotFoundException();
        }

        $connectRequest->update(array_merge($data, [
            'accepted_at' => now(),
        ]));

        return new ConnectResource($connectRequest);
    }

    
    /* Ignore/Delete Connect Requests */

    public function destroy()
    {
        $data = request()->validate([
            'user_id' => 'required',
        ]);

        try {
            Connect::where('user_id', $data['user_id'])
                ->where('connect_id', auth()->user()->id)
                ->firstOrFail()
                ->delete();
        } catch (ModelNotFoundException $e) {
            throw new ConnectRequestNotFoundException();
        }

        return response()->json([], 204);
    }
}