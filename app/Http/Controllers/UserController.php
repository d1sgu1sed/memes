<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts;
        $comments = $user->comments()->where('approved', true)->get();

        return view('users.show', compact('user', 'posts', 'comments'));
    }

    public function getPosts(User $user){
        $posts = $user->posts;
        return view('users.partials.posts', compact('user', 'posts'));
    }

    public function getComments(User $user){
        $comments = $user->comments()->where('approved', true)->get();
        return view('users.partials.comments', compact('user', 'comments'));
    }
}
