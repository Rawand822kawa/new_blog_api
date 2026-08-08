<?php
namespace App\Modules\Comments\Actions;

use App\Modules\Comments\Models\Comment;

class DeleteComment
{
    public function execute(array $data, Comment $comment): void
    {
        if ($comment->user_id == $data['user_id']) {
            $comment->delete();
        } else {
            abort(403, 'Unauthorized!!');
        }
    }
}