<?php

namespace App\Http\Controllers\Admin\Modules\Posts;


use App\Http\Requests\Admin\Modules\Posts\CreatePostRequest;
use App\Http\Requests\Admin\Modules\Posts\UpdatePostRequest;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Services\Admin\Posts\PostActionService;
use App\Services\Admin\Posts\PostService;
use App\Traits\ThumbnailController;

class PostsController extends BaseAdminController
{
    use ThumbnailController;

    public $requests = [
        'store' => CreatePostRequest::class,
        'update' => UpdatePostRequest::class
    ];

    protected $massAction = PostActionService::class;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
}
