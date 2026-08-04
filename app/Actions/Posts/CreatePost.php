<?php 

namespace App\Actions\Posts;

use App\Models\Post;

class CreatePost{

public function execute(array $data):Post{

return Post::create([
  
  'user_id'=>$data['user_id'],
  'title'=>$data['title'],
  'content'=>$data['content'],
  'image'=>$data['image']

]);


}

}