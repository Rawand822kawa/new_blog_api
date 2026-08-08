<?php

namespace App\Modules\Comments\Models;

use App\Modules\Posts\Models\Post;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}

