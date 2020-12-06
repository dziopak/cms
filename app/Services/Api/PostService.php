<?php

namespace App\Services\Api;

use App\Entities\Post;
use App\Repositories\PostRepository;

class PostService extends BaseApiService
{
    protected $access = 'POST';
    public $model = Post::class;


    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
}
