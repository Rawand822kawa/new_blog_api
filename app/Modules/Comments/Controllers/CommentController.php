<?php

namespace App\Modules\Comments\Controllers;

use App\Modules\Comments\Actions\DeleteComment;
use App\Modules\Comments\Actions\PostComment;
use App\Modules\Comments\Requests\CreateCommentRequest;
use App\Modules\Comments\Models\Comment;
use App\Modules\Posts\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController
{
    // GET 
    public function index($id)
    {
        $comments = Comment::where('post_id', $id)->get();

        return response()->json($comments);
    }

    // POST 
    public function store(CreateCommentRequest $request, $id, PostComment $postComment)
    {
        $ValidatedData = $request->validated();
        $UserId = ['user_id' => $request->user()->id];

        $mergedArray = array_merge($ValidatedData, $UserId);

        $comment = $postComment->execute($mergedArray, $id);

        return response()->json([
            'message' => 'Comment added successfully!',
            'comment' => $comment,
        ], 201);
    }

    // DELETE 
    public function destroy(Request $request, $id, DeleteComment $deleteComment)
    {
        $deleteComment->execute([
            'user_id' => $request->user()->id
        ], $id);

        return response()->json([
            'message' => 'Comment deleted successfully!'
        ]);
    }
}