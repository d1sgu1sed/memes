<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class PostController extends Controller
{
  public function createForm()
  {
      return view('posts.create');
  }

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

  public function edit(Post $post)
  {
      return view('posts.edit', compact('post'));
  }

  public function update(Request $request, Post $post)
  {
      $request->validate([
          'title' => 'required|string|max:255',
          'content' => 'required|string',
          'image' => 'required'
      ]);

      $post->update([
          'title' => $request->title,
          'content' => $request->content,
          'image' => $request->image
      ]);

      return redirect()->route('home')->with('status', 'Пост успешно обновлен.');
  }

  public function destroy(Post $post)
  {
      $post->delete();

      return redirect()->route('home')->with('status', 'Пост успешно удален.');
  }
}
