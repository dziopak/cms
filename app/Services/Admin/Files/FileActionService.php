<?php

namespace App\Services\Admin\Files;

use App\Events\Files\FileDestroyEvent;
use App\Events\Files\FileUpdateEvent;
use App\Repositories\FileRepository;
use App\Services\Admin\BaseActionService;

class FileActionService extends BaseActionService
{
    public $events = [
        'delete' => FileDestroyEvent::class,
        'name_replace' => FileUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new FileRepository;
        $this->model = 'File';
        parent::__construct($data);
    }
}
