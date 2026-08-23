<?php

return [
    App\Providers\AppServiceProvider::class,
    Modules\Posts\Providers\PostServiceProvider::class,
    Modules\Comments\Providers\CommentServiceProvider::class,
    Modules\User\Providers\UserServiceProvider::class,
];
