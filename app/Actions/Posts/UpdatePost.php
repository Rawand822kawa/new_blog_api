<?php
namespace App\Actions\Posts;

use App\Models\Post;

class UpdatePost{

public function execute(array $data, int $id ):Post{

  $post = Post::findOrFail($id);  //boya null nabetu false be agar post buni nabu

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