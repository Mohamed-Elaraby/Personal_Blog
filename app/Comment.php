<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'comments';
    protected $fillable = ['content', 'user_id', 'post_id'];
    protected $primaryKey = 'id';
    public $dates = ['deleted_at'];

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post ()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
