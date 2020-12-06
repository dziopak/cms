<?php

namespace App\Services\Admin\Sliders;

use App\Interfaces\Repositories\SliderRepositoryInterface;
use App\Services\Admin\BaseAdminService;

class SliderService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'slider';
    const ENTITY_PLURAL = 'sliders';
    const ROUTE = 'admin.blocks.sliders';

    public function __construct(SliderRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
