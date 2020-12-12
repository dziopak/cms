<?php

namespace App\Traits;

use App\Entities\File;

trait CategorizableService
{
    public function synchronizeCategories($request, $id)
    {
        $item = $this->repository->find($id);
        $item->categories()->sync($request->get('category'));
    }
}
