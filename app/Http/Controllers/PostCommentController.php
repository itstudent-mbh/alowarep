<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function create(request $request)
    {
        $validate = $request->validate([
            'user_name'=>'required|max:100',
            'comment' => 'required',
        ]);

        $comment = PostComment::create([
            'user_name' => $request->user_name,
            'comment' =>  $request->comment,
            'post_comment_id' => ($request->post_comment_id) ? $request->post_comment_id : null
        ]);
        if ($request->post_comment_id != null){
            $comments = PostComment::where([
                ['post_id', '=', 1],
                ['post_comment_id','=', null]])
                ->orderBy('created_at', 'desc')
                ->with(['childs'])
                ->get();
            return response()->json($comments);
        }else
            return response()->json($comment);
    }
}
