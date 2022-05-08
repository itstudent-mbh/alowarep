<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_name',
        'comment',
        'post_comment_id'
    ];


    public function parent(){
        return $this->belongsTo(PostComment::class);
    }

    // get comment replies
    public function childs(){
        return $this->hasMany(PostComment::class)->orderBy('created_at', 'desc')->with(['childs']);
    }
}
