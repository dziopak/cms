<?php

namespace App\Services\Admin\Categories;

use App\Events\Categories\CategoryUpdateEvent;
use App\Events\Categories\CategoryDestroyEvent;
use App\Repositories\CategoryRepository;
use App\Services\Admin\BaseActionService;

class CategoryActionService extends BaseActionService
{
    public $events = [
        'category' => CategoryUpdateEvent::class,
        'delete' => CategoryDestroyEvent::class,
        'name_replace' => CategoryUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new CategoryRepository;
        $this->model = 'Category';
        parent::__construct($data);
    }
}
