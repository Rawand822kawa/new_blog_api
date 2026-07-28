<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // GET /api/posts
    public function index()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    // GET /api/posts/{id}
    public function show($id)
    {
        $post = Post::find($id);

        return response()->json($post);
    }

    // POST /api/posts
    public function store(Request $request)
    {
        // Validate the data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Create the post
        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => null,
        ]);

        // Return response
        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post,
        ], 201);
    }

    // PUT /api/posts/{id}
    public function update(Request $request, $id)
    {
        // Validate the data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Find the post
        $post = Post::find($id);

        // Check if the post exists
        if (!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        // Check ownership
        if ($post->user_id != Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        // Update the post
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // Return response
        return response()->json([
            'message' => 'Post updated successfully!',
            'post' => $post,
        ]);
    }
    public function destroy($id)
{
    $post = Post::find($id);

    if (!$post) {
        return response()->json([
            'message' => 'Post not found'
        ], 404);
    }

    if ($post->user_id != Auth::id()) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
    }

    $post->delete();

    return response()->json([
        'message' => 'Post deleted successfully!'
    ]);
}
}