<?php

namespace App\Repositories;


use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\DB;
use App\Traits\Repository;
use App\Entities\Setting;
use App\Interfaces\Repositories\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    use Repository;

    /**
     * The model being queried.
     *
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = app(Setting::class);
        $this->filters[] = AllowedFilter::exact('id');
    }

    public function store($data, $group)
    {
        DB::transaction(function () use ($data, $group) {
            foreach ($data as $setting => $value) {
                DB::table('settings')->updateOrInsert([
                    'name' => $setting
                ], [
                    'name' => $setting,
                    'value' => $value,
                    'group' => $group,
                ]);
            }
        });
    }
}
