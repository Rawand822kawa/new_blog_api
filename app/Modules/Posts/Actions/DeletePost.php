<?php

namespace App\Modules\Posts\Actions;

use App\Modules\Posts\Models\Post;

class DeletePost
{
    public function execute(array $data, Post $post): void
    {
        if ($post->user_id != $data['user_id']) {
            abort(403, 'Unauthorized');
        }

        $post->delete();
    }
}