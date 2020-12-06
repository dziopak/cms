<?php

namespace App\Services\Admin\Carousels;

use App\Events\Carousels\CarouselDestroyEvent;
use App\Events\Carousels\CarouselUpdateEvent;
use App\Repositories\CarouselRepository;
use App\Services\Admin\BaseActionService;

class CarouselActionService extends BaseActionService
{
    public $events = [
        'category' => CarouselUpdateEvent::class,
        'delete' => CarouselDestroyEvent::class,
        'name_replace' => CarouselUpdateEvent::class,
    ];

    public function __construct($data)
    {
        $this->repository = new CarouselRepository;
        $this->model = 'Category';
        parent::__construct($data);
    }
}
