<?php
namespace Modules\Comments\Actions;

use Modules\Comments\Models\Comment;
use Modules\Posts\Models\Post;

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