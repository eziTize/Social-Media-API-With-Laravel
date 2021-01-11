<?php

namespace App;

use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

   /* protected $fillable = [
        'body', 'privacy', 'title', 'user_id', 'type', 'profanity', 'image'
    ]; */

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ReverseScope());

    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function votes()
    {
        return $this->belongsToMany(User::class, 'votes', 'post_id', 'user_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
