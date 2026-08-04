<?php

namespace App\Actions\Posts;

use App\Models\Post;

class DeletePost{

public function execute(array $data,int $id):void{

  $post = Post::findOrFail($id);

  if($post->user_id != $data['user_id']){
    abort(403, 'Unauthorized');
  }
  $post->delete();
}
}