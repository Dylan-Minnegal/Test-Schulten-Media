<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'task_id' => 'required|exists:tasks,id',
        ]);

        $comment = Comment::create([
            'comment' => $request->comment,
            'task_id' => $request->task_id,
            'user_id' => $request->user_id,  
        ]);

        return response()->json($comment, 201);
    }
}
