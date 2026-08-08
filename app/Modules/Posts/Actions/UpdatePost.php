<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Models\Post;

class UpdatePost
{
    public function execute(array $data, Post $post): Post
    {
        if ($post->user_id != $data['user_id']) {
            abort(403, 'Unauthorized');
        }

        $post->update([
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        return $post;
    }
}