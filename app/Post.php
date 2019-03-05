<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'user_id'];
    protected $primaryKey = 'id';

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments ()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
