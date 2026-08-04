<?php

namespace App\Actions\Comment;

use App\Models\Comment;
use App\Models\Post;


class PostComment{
  public function execute(array $data,int $id):Comment{
    
  $post=Post::findOrFail($id);

  $comment = Comment::create([
    'comment'=>$data['comment'],
    'user_id'=>$data['user_id'],
    'post_id'=>$id
    ]
  );
  return $comment;
  }
}