<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function comments()
    {
        $comments = Comment::where('moderated', false)->get();
        return view('admin.comments', compact('comments'));
    }

    public function approveComment(Comment $comment)
    {
        DB::transaction(function () use ($comment) {
            $comment->update(['approved' => true, 'moderated' => true]);
        });

        return redirect()->route('admin.comments')->with('status', 'Комментарий одобрен.');
    }

    public function rejectComment(Comment $comment)
    {
        DB::transaction(function () use ($comment) {
            $comment->update(['approved' => false, 'moderated' => true]);
        });

        return redirect()->route('admin.comments')->with('status', 'Комментарий отклонен.');
    }
}
