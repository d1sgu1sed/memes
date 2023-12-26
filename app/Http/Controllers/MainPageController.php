<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class MainPageController extends Controller
{


  public function index()
  {
      $posts = Post::latest()->paginate(10);
      return view('dashboard', compact('posts'));
      // $userLiked = $posts->likes()->where('user_id', auth()->id())->exists();
      // return view('dashboard', compact('posts', 'userLiked'));
  }
}
