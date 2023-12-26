<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class MainPageController extends Controller
{


  public function index()
  {
      $posts = Post::latest()->paginate(10);

      return view('dashboard', compact('posts'));
  }
}
