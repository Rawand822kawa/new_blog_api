<?php
namespace App\Actions\Comment;

use App\Models\Comment;

class DeleteComment{

public function execute(array $data,int $id):void{

  $comment = Comment::findOrFail($id);

  if($comment->user_id == $data['user_id']){
  $comment->delete();
  }
  else{
    abort(403,'Unauthorized!!');
  }

}
}