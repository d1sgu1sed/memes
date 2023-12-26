<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request, Post $post)
  {
      $request->validate([
          'comment' => 'required',
      ]);

      $comment = $post->comments()->create([
          'user_id' => auth()->id(),
          'comment_text' => $request->input('comment'),
          'moderated' => false,
          'approved' => false,
      ]);

      return redirect()->route('posts.show', $post)->with('success', 'Комментарий добавлен');
  }
}
