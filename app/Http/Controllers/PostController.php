<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $comments = PostComment::where([
            ['post_id', '=', 1],
            ['post_comment_id','=', null]])
            ->orderBy('created_at', 'desc')
            ->with(['childs'])
            ->get();
        //return response()->json($comments);
        return view('post' , compact('comments'));
    }
}
