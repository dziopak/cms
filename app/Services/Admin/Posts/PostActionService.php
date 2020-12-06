<?php

namespace App\Services\Admin\Posts;

use App\Events\Posts\PostDestroyEvent;
use App\Events\Posts\PostUpdateEvent;
use App\Repositories\PostRepository;
use App\Services\Admin\BaseActionService;

class PostActionService extends BaseActionService
{
    public $events = [
        'category' => PostUpdateEvent::class,
        'delete' => PostDestroyEvent::class,
        'name_replace' => PostUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new PostRepository;
        $this->model = 'Post';
        parent::__construct($data);
    }
}
