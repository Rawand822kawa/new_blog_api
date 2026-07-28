<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'comment' => $request->input('comment'),
        ]);

        return response()->json([
            'message' => 'Comment added successfully!',
            'comment' => $comment,
        ], 201);
    }

    // DELETE /api/comments/{id}
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found'
            ], 404);
        }

        if ($comment->user_id != Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'message' => 'Comment deleted successfully!'
        ]);
    }
}