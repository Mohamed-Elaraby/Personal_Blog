<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'user_id'];
    protected $primaryKey = 'id';
    public $dates = ['deleted_at'];

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments ()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
