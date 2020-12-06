<?php

namespace App\Services\Admin\Settings;

use App\Interfaces\Repositories\SettingRepositoryInterface;

class SettingsService
{

    public function __construct(SettingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    // TO DO //
    // SETTINGS ACCESS //

    public function store($request, $group)
    {
        $data = $request->except('_token');
        $this->repository->store($data, $group);

        return redirect()->back();
    }
}
