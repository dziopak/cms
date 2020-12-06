<?php

namespace App\Services\Admin\Users;

use App\Events\Users\UserDestroyEvent;
use App\Events\Users\UserUpdateEvent;
use App\Repositories\UserRepository;
use App\Services\Admin\BaseActionService;

class UserActionService extends BaseActionService
{
    public $events = [
        'category' => UserUpdateEvent::class,
        'delete' => UserDestroyEvent::class,
        'name_replace' => UserUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new UserRepository;
        $this->model = 'User';
        parent::__construct($data);
    }
}
