<?php

namespace App\Services\Admin\Menus;

use App\Events\Categories\MenuUpdateEvent;
use App\Events\Categories\MenuDestroyEvent;
use App\Repositories\MenuRepository;
use App\Services\Admin\BaseActionService;

class MenuActionService extends BaseActionService
{
    public $events = [
        'delete' => MenuDestroyEvent::class,
        'name_replace' => MenuUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new MenuRepository;
        $this->model = 'Menu';
        parent::__construct($data);
    }
}
