<?php

namespace App\Traits;

use App\Http\Requests\BaseFormRequest;

trait ThumbnailController
{
    public function update(BaseFormRequest $request, $id)
    {
        if ($request->get('request') === 'photo') {
            return $this->service->updateThumbnail($id, $request->get('file'));
        }
        return parent::update($request, $id);
    }
}
