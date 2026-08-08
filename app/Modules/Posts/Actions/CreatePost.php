<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Models\Post;

class CreatePost
{
    public function execute(array $data): Post
    {
        return Post::create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $data['image'] ?? null,
        ]);
    }
}