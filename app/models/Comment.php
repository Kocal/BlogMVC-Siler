<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    const CREATED_AT = 'created';

    protected $fillable = ['post_id', 'username', 'email', 'content'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function setUpdatedAt($value)
    {

    }
}
