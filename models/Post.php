<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'content',
        'created',
    ];

    protected $with = ['user', 'category'];

    const CREATED_AT = 'created';

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setUpdatedAt($value)
    {

    }
}
