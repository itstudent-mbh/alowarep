<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($id)
    {
        $comments = PostComment::where('post_id',$id)->where('post_comment_id',null)->orderBy('created_at', 'desc')->with(['childs'])->get();
        return view('post' , compact('comments'));
    }
}
