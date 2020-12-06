<?php

namespace App\Services\Admin\Menus;

use App\Interfaces\Repositories\MenuRepositoryInterface;
use App\Services\Admin\BaseAdminService;

class MenuService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'menu';
    const ENTITY_PLURAL = 'menus';
    const ROUTE = 'admin.blocks.menus';

    public function __construct(MenuRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}
