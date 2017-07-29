<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const CREATED_AT = 'created';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function setUpdatedAt($value)
    {
        
    }
}
