<?php

namespace App\Services\Admin\Layouts;

use App\Events\Layouts\LayoutDestroyEvent;
use App\Events\Layouts\LayoutUpdateEvent;
use App\Repositories\LayoutRepository;
use App\Services\Admin\BaseActionService;

class LayoutActionService extends BaseActionService
{
    public $events = [
        'delete' => LayoutDestroyEvent::class,
        'name_replace' => LayoutUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new LayoutRepository;
        $this->model = 'Layout';
        parent::__construct($data);
    }
}
