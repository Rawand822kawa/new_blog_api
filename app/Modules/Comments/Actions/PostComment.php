<?php
namespace App\Modules\Comments\Actions;

use App\Modules\Comments\Models\Comment;
use App\Modules\Posts\Models\Post;

class PostComment
{
    public function execute(array $data, Post $post): Comment
    {
        $comment = Comment::create([
            'comment' => $data['comment'],
            'user_id' => $data['user_id'],
            'post_id' => $post->id
        ]);

        return $comment;
    }
}