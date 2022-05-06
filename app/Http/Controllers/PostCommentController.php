<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index($post_id)
    {
        $comments = PostComment::where('post_id',$post_id)->with(['childs'])->get();
        return response()->json($comments);
    }

    public function create(request $request)
    {
        $request->validate([
            'user_name'=>'required|max:100',
            'comment' => 'required',
        ]);
        $comment = PostComment::create([
            'user_name' => $request->user_name,
            'comment' =>  $request->comment,
            'post_comment_id' => ($request->post_comment_id) ? $request->post_comment_id : null
        ]);

        return response()->json($comment);
    }
}
