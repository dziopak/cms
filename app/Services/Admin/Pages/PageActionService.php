<?php

namespace App\Services\Admin\Pages;

use App\Events\Pages\PageDestroyEvent;
use App\Events\Pages\PageUpdateEvent;
use App\Repositories\PageRepository;
use App\Services\Admin\BaseActionService;

class PageActionService extends BaseActionService
{
    public $events = [
        'category' => PageUpdateEvent::class,
        'delete' => PageDestroyEvent::class,
        'name_replace' => PageUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new PageRepository;
        $this->model = 'Page';
        parent::__construct($data);
    }
}
