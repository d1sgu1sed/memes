<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{

  public function show(Post $post)
  {
      if ($post->isPublished() || auth()->user() && auth()->user()->id === $post->user->id){
          return view('post.show', compact('post'));
      }
      return abort('404');
  }

  public function create(Request $request)
{
  $request->validate([
      'title' => 'required|max:255',
      'content' => 'required',
  ]);

  $publishedAt = $request->has('schedule_post') ? $request->input('published_at') : null;

  auth()->user()->posts()->create([
      'title' => $request->input('title'),
      'content' => $request->input('content'),
      'published_at' => $publishedAt,
      'image' => $request->file('image')->store('uploads', 'public'),
  ]);

  return redirect()->route('dashboard')->with('success', 'Пост успешно создан');
}

  public function destroy(Post $post)
  {
      $post->delete();

      return redirect()->route('dashboard')->with('status', 'Пост успешно удален.');
  }
}
