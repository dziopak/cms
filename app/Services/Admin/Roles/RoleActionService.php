<?php

namespace App\Services\Admin\Roles;

use App\Events\Roles\RoleDestroyEvent;
use App\Events\Roles\RoleUpdateEvent;
use App\Repositories\RoleRepository;
use App\Services\Admin\BaseActionService;

class RoleActionService extends BaseActionService
{
    public $events = [
        'category' => RoleUpdateEvent::class,
        'delete' => RoleDestroyEvent::class,
        'name_replace' => RoleUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new RoleRepository;
        $this->model = 'Role';
        parent::__construct($data);
    }
}
