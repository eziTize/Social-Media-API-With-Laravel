<?php

namespace App\Http\Controllers;

use App\Http\Resources\MomentCollection;
use App\User;
use Illuminate\Http\Request;

class UserMomentController extends Controller
{
    public function index(User $user)
    {

        return new MomentCollection($user->posts->where('type', 'Moment'));
    }
}