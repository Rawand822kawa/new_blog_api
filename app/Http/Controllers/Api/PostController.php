<?php

namespace App\Http\Controllers\Api;

use App\Actions\Posts;
use App\Actions\Posts\CreatePost;
use App\Actions\Posts\DeletePost;
use App\Actions\Posts\UpdatePost;
use App\Http\Controllers\Controller;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
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
    public function store(CreatePostRequest $request, CreatePost $createPost)
    {
        // Validate the data
        

        $post=$createPost->execute(
            [
                $request->validated()
            ]
        );

        // Return response
        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post,
        ], 201);
    }

    // PUT /api/posts/{id}
    public function update(UpdatePostRequest $request, $id, UpdatePost $updatePost)
    {
        // Validate the data
        

        $post = $updatePost->execute([
        $request->validated()
        ] 
        ,$id);


        // Return response
        return response()->json([
            'message' => 'Post updated successfully!',
            'post' => $post,
        ]);
    }
    public function destroy(Request $request,int $id, DeletePost $deletePost)
{
    $deletePost->execute(['user_id'=>$request->user()->id],$id);

    return response()->json([
        'message' => 'Post deleted successfully!'
    ]);
}

}