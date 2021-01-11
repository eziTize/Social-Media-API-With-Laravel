<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    protected $guarded = [];
    protected $table = "connects";
    protected $dates = ['accepted_at', 'created_at'];

    public static function connection($userId)
    {
        return (new static())
            ->where(function ($query) use ($userId) {
                return $query->where('user_id', auth()->user()->id)
                    ->where('connect_id', $userId);
            })
            ->orWhere(function ($query) use ($userId) {
                return $query->where('connect_id', auth()->user()->id)
                    ->where('user_id', $userId);
            })
            ->first();
    }


    public static function connections()
    {
        return (new static())
            ->whereNotNull('accepted_at')
            ->where(function ($query) {
                return $query->where('user_id', auth()->user()->id)
                    ->orWhere('connect_id', auth()->user()->id);
            })
            ->get();
    }
}