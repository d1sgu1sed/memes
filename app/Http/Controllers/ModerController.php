<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModerController extends Controller
{
    public function comments()
    {
        $comments = Comment::where('moderated', false)->get();
        return view('moderate.comments', compact('comments'));
    }

    public function approveComment(Comment $comment)
    {
        DB::transaction(function () use ($comment) {
            $comment->update(['approved' => true, 'moderated' => true]);
        });

        return redirect()->route('moderate.comments')->with('status', 'Комментарий одобрен.');
    }

    public function rejectComment(Comment $comment)
    {
        DB::transaction(function () use ($comment) {
            $comment->update(['approved' => false, 'moderated' => true]);
        });

        return redirect()->route('moderate.comments')->with('status', 'Комментарий отклонен.');
    }
}
