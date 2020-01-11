<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Carbon\Carbon;
use App\Reply;

class CommentsController extends Controller
{
    function comment(){
      $comments = Comment::all();
      $replies = Reply::all();
      return view('comment.commentpage', compact('comments', 'replies'));
    }
    function commentinsert(Request $request){
      $comment_id = Comment::insertGetId([
        'comment_email' => $request->comment_email,
        'user_comment' => $request->user_comment,
        'created_at' => Carbon::now(),
      ]);
      return back();
    }
}
