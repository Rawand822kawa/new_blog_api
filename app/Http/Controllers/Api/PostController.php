<?php

namespace App\Http\Controllers\Api;

use App\Actions\Posts;
use App\Actions\Posts\CreatePost;
use App\Actions\Posts\DeletePost;
use App\Actions\Posts\UpdatePost;
use App\Http\Controllers\Controller;
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
    public function store(Request $request, CreatePost $createPost)
    {
        // Validate the data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $post=$createPost->execute(
            [
                'user_id'=>$request->user->id,
                'title'=>$request['title'],
                'content'=>$request['content'],
                'image'=>$request['image']
            ]
        );

        // Return response
        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post,
        ], 201);
    }

    // PUT /api/posts/{id}
    public function update(Request $request, $id, UpdatePost $updatePost)
    {
        // Validate the data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $post = $updatePost->execute([
        'user_id'=>$request->user()->id,
        'title'=>$request['title'],
        'content'=>$request['content']
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