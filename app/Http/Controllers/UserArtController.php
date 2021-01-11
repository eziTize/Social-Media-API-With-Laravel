<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtCollection;
use App\User;
use Illuminate\Http\Request;

class UserArtController extends Controller
{
    public function index(User $user)
    {

        return new ArtCollection($user->posts->where('type', 'Art'));
    }
}