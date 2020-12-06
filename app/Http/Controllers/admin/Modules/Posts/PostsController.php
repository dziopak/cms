<?php

namespace App\Http\Controllers\Admin\Modules\Posts;


use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Modules\Posts\PostsRequest;
use App\Services\Admin\Posts\PostActionService;
use App\Services\Admin\Posts\PostService;
use App\Traits\ThumbnailController;

class PostsController extends BaseAdminController
{
    use ThumbnailController;

    public $requests = [
        'store' => PostsRequest::class,
        'update' => PostsRequest::class
    ];

    protected $massAction = PostActionService::class;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
}
