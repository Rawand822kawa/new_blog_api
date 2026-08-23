<?php

namespace Modules\Comments\HTTP\Controllers;

use Modules\Comments\Actions\DeleteComment;
use Modules\Comments\Actions\PostComment;
use Modules\Comments\Requests\CreateCommentRequest;
use Modules\Comments\Models\Comment;
use Modules\Posts\Models\Post;
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
