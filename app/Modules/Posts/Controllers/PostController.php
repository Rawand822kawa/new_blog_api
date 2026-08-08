<?php

namespace App\Modules\Posts\Controllers;

use App\Modules\Posts\Actions\CreatePost;
use App\Modules\Posts\Actions\DeletePost;
use App\Modules\Posts\Actions\UpdatePost;
use App\Modules\Posts\Models\Post;
use App\Modules\Posts\Requests\CreatePostRequest;
use App\Modules\Posts\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController
{
    // GET 
    public function index()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    // GET 
    public function show(Post $post)
    {
        return response()->json([
            'post' => $post
        ]);
    }

    // POST 
    public function store(CreatePostRequest $request, CreatePost $createPost)
    {
        $data = $request->validated();

        $user = [
            'user_id' => $request->user()->id,
        ];

        $mergedArray = array_merge($data, $user);

        $post = $createPost->execute($mergedArray);

        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post,
        ], 201);
    }

    // PUT 
    public function update(
        UpdatePostRequest $request,
        Post $post,
        UpdatePost $updatePost
    ) {
        $data = $request->validated();

        $user_id = [
            'user_id' => Auth::id()
        ];

        $mergedarray = array_merge($data, $user_id);

        $post = $updatePost->execute(
            $mergedarray,
            $post
        );

        return response()->json([
            'message' => 'Post updated successfully!',
            'post' => $post,
        ]);
    }

    public function destroy(
        Request $request,
        Post $post,
        DeletePost $deletePost
    ) {
        $deletePost->execute(
            ['user_id' => $request->user()->id],
            $post
        );

        return response()->json([
            'message' => 'Post deleted successfully!'
        ]);
    }
}