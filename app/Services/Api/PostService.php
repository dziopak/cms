<?php

namespace App\Services\Api;

use App\Entities\Post;
use App\Events\Posts\PostDestroyEvent;
use App\Http\Requests\Api\Modules\Posts\CreatePostRequest;
use App\Repositories\PostRepository;

class PostService extends BaseApiService
{
    protected $access = 'POST';
    public $model = Post::class;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
        $this->events = [
            'destroy' => PostDestroyEvent::class
        ];
    }

    public function store($data)
    {
        return ModelStoreService::build($this, $data, CreatePostRequest::class);
    }
}
