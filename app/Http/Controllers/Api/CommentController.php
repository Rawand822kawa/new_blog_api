<?php

namespace App\Http\Controllers\Api;

use App\Actions\Comment\DeleteComment;
use App\Actions\Comment\PostComment;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // GET /api/posts/{id}/comments
    public function index($id)
    {
        $comments = Comment::where('post_id', $id)->get();

        return response()->json($comments);
    }

    // POST /api/posts/{id}/comments
    public function store(CreateCommentRequest $request, $id, PostComment $postComment)
    {
    $ValidatedData = $request->validated();
    
    $UserId =[ 'user_id'=>$request->user()->id];

    $mergedArray = array_merge($ValidatedData,$UserId);


    $comment = $postComment->execute($mergedArray,$id);
        

        return response()->json([
            'message' => 'Comment added successfully!',
            'comment' => $comment,
        ], 201);
    }

    // DELETE /api/comments/{id}
    public function destroy(Request $request,$id, DeleteComment $deleteComment)
    {
        $deleteComment->execute([
            'user_id'=>$request->user()->id
        ],$id);

        return response()->json([
            'message' => 'Comment deleted successfully!'
        ]);
    }
}