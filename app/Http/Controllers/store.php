<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Comment;
use Carbon\Carbon;

class ReplysController extends Controller
{
  function commentreply($comment_id){
    $comment_info = Comment::where('id', '=', $comment_id)->first();
    return view('comment.replypage', compact('comment_info'));
  }
  function replyinsert(Request $request){
     Reply::insertGetId([
      'reply_email' => $request->reply_email,
      'comment_id' => $request->comment_id,
      'reply_comment' => $request->reply_comment,
      'created_at' => Carbon::now(),
    ]);
    // $comment_info = Comment::where('id', '=', $comment_id)->first();
    // return view('comment.replypage', compact('comment_info'));
  }
}
