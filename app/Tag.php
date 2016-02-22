<?php

namespace selftotten;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
