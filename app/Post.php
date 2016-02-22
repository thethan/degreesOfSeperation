<?php

namespace selftotten;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }


}
