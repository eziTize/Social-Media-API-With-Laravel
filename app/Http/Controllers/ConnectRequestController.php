<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Exceptions\ValidationErrorException;
use App\Connect;
use App\Http\Resources\Connect as ConnectResource;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class ConnectRequestController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'connect_id' => 'required',
        ]);



        try {
            
            User::find($data['connect_id'])
            //->connects()->attach(auth()->user());
            ->connects()->syncWithoutDetaching(auth()->user());
        } catch (ModelNotFoundException $e) {

            throw new UserNotFoundException();
        }

        return new ConnectResource(
            Connect::where('user_id', auth()->user()->id)
                ->where('connect_id', $data['connect_id'])
                ->first()
        );
    }
}