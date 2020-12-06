<?php

namespace App\Services\Admin\Carousels;

use App\Interfaces\Repositories\CarouselRepositoryInterface;
use App\Services\Admin\BaseAdminService;

class CarouselService extends BaseAdminService
{
    const ENTITY_SINGULAR = 'carousel';
    const ENTITY_PLURAL = 'carousels';
    const ROUTE = 'admin.blocks.carousels';

    public function __construct(CarouselRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function update($request, $id, $params = null)
    {
        // Custom action before update
        $before = function () use ($request, $id) {
            $item = $this->repository->find($id);
            $item->files()->sync($request->get('image'));
        };

        // Update with custom action before
        return parent::update($request, $id, [
            'before' => $before
        ]);
    }
}
